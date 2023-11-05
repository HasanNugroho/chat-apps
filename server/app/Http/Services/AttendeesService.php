<?php
namespace App\Http\Services;

use App\Models\Attendees as AttendeesModel;
use Illuminate\Support\Str;
use App\Http\Notification;
use App\Http\Attendees;

class AttendeesService {
    public function store(string $userId, string $roomId, string $displayName, int $participantType = Attendees::PARTICIPANT_TYPE_USER) {
        $data = [
            'aktor_id' => $userId,
            'room_id' => $roomId,
            'display_name' => $displayName,
            'participant_type' => $participantType,
            'notification_level' => Notification::NOTIF_ALL_TYPE,
        ];
        try {
            $room = AttendeesModel::create($data);
            return $room;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
