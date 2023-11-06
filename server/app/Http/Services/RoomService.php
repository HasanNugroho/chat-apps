<?php
namespace App\Http\Services;

use App\Models\Room as RoomModels;
use App\Models\User;
use App\Http\Services\AttendeesService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Attendees;
use App\Http\Room;

class RoomService {
    protected RoomModels $roomModels;
    protected AttendeesService $attendeesService;

    public function __construct(RoomModels $roomModels,
                                AttendeesService $attendeesService) {
        $this->roomModels = $roomModels;
        $this->attendeesService = $attendeesService;
    }

    public function store(array $data) {
        $dataStore = [
            'type' => $data['type'],
            'token' => Str::random(9),
            'name' => $data['type'] == Room::ROOM_PRIVATE_TYPE ? 'private' : $data['name']
        ];

        // check user invited
        try {
            $data['invite'] = $this->attendeesService->checkUserList($data['invite']);
        } catch (\Throwable $th) {
            throw $th;
        }

        // set description
        if (isset($data['description'])) {
            $dataStore['description'] = $data['description'];
        }

        // store data room
        try {
            $room = $this->roomModels->create($dataStore);
        } catch (\Throwable $th) {
            throw $th;
        }

        // store user moderator
        try {
            $this->attendeesService->store(
                Auth::user()->id, 
                $room->id, 
                Auth::user()->name, 
                $data['type'] == Room::ROOM_PRIVATE_TYPE ? Attendees::PARTICIPANT_TYPE_USER : Attendees::PARTICIPANT_TYPE_MODERATOR
            );
        } catch (\Throwable $th) {
            throw $th;
        }
        
        // Store common users
        if (isset($data['invite']) && is_array($data['invite'])) {
            foreach ($data['invite'] as $user) {
                try {
                    $this->attendeesService->store($user['id'], $room->id, $user['name'], Attendees::PARTICIPANT_TYPE_USER);
                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        }

        return $room;
    }

    public function getIdByToken(string $token) {
        $room = $this->roomModels->with('chat')->where('token', $token)->select('id')->first();
        return $room->id;
    }

}
