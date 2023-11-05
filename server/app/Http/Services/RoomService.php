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
    public function store(array $data) {

        $dataStore = [
            'type' => $data['type'],
            'token' => Str::random(9),
            'name' => $data['type'] == Room::ROOM_PRIVATE_TYPE ? 'private' : $data['name']
        ];

        if (isset($data['description'])) {
            $dataStore['description'] = $data['description'];
        }

        
        
        // store data room
        try {
            $room = RoomModels::create($dataStore);
        } catch (\Throwable $th) {
            throw $th;
        }

        // store user moderator
        try {
            $AttendeesService = new AttendeesService();
            $AttendeesService->store(Auth::user()->id, $room->id, Auth::user()->name, $data['type'] == Room::ROOM_PRIVATE_TYPE ? Attendees::PARTICIPANT_TYPE_USER : Attendees::PARTICIPANT_TYPE_MODERATOR);
        } catch (\Throwable $th) {
            throw $th;
        }
        
        // store common user 
        foreach($data['invite'] as $userId) {
            try {
                $displayName = User::select('name')->where('id', $userId)->first();
                $AttendeesService = new AttendeesService();
                $AttendeesService->store($userId, $room->id, $displayName->name, Attendees::PARTICIPANT_TYPE_USER);
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        return $room;
    }

    public function getRooms(string $uid, int $limit = 20) {
        $room = new RoomModels();
        $room->limit(10);

    }
}
