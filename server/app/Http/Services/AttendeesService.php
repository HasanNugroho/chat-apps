<?php
namespace App\Http\Services;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Attendees as AttendeesModel;
use App\Models\User as UserModel;
use Illuminate\Support\Str;
use App\Http\Notification;
use App\Http\Attendees;

class AttendeesService {
    protected AttendeesModel $attendeesModel;
    protected UserModel $userModel;

    public function __construct(AttendeesModel $attendeesModel,
                                UserModel $userModel) {
        $this->attendeesModel = $attendeesModel;
        $this->userModel = $userModel;
    }

    public function store(string $userId, string $roomId, string $displayName, int $participantType = Attendees::PARTICIPANT_TYPE_USER) {
        $data = [
            'aktor_id' => $userId,
            'room_id' => $roomId,
            'display_name' => $displayName,
            'participant_type' => $participantType,
            'notification_level' => Notification::NOTIF_ALL_TYPE,
        ];
        try {
            $room = $this->attendeesModel->create($data);
            return $room;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function checkUserList(array $data) {
        $userList = [];
        foreach ($data as $userId) {
            try {
                $user = $this->userModel->select('id', 'name')->findOrFail($userId)->toArray();
                $userList[] = $user;
            } catch (ModelNotFoundException $exception) {
                throw(new \ErrorException('list user not found'));
            }
        }
        return $userList;
    }
}
