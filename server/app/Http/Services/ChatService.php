<?php
namespace App\Http\Services;

use App\Http\Services\AttendeesService;
use App\Models\Chat as ChatModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Chat;

class ChatService {
    protected ChatModel $chatModel;
    protected RoomService $roomService;
    protected AttendeesService $attendeesService;

    public function __construct(ChatModel $chatModel,
                                RoomService $roomService,
                                AttendeesService $attendeesService) {
        $this->chatModel = $chatModel;
        $this->roomService = $roomService;
        $this->attendeesService = $attendeesService;
    }

    public function sendMessage(string $token, array $data) {
        $dataStore = [
            'aktor_id' => Auth::user()->id,
            'room_id' => $this->roomService->getIdByToken($token),
            'verb' => Chat::VERB_COMMENT_TYPE,
            'type' => Chat::CHAT_MESSAGE_TYPE,
            'message' => $data['message'],
        ];

        // jika parent_id ada
        if (isset($data['parent_id'])) {
            // add data about reply chat
            $dataStore['parent_id'] = $data['parent_id'];
            $dataStore['topmost_parent_id'] = $this->getTopParentId($data['parent_id']);
            
            $this->setchildcount($data['parent_id']);
        }

        // store data message
        try {
            $chat = $this->chatModel->create($dataStore);
            return $chat;
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    // function to set counter child message
    protected function setChildCount(string $chatId) {
        $chat = $this->chatModel->findOrFail($chatId);
        $chat->increment('children_count', 1); 
    }
    
    // get id of top parent message
    protected function getTopParentId(string $chatId) {
        $chat = $this->chatModel->select('topmost_parent_id')->findOrFail($chatId)->toArray();
        if ($chat['topmost_parent_id']) {
            return $chat['topmost_parent_id'];
        }
        return $chatId;
    }

    

}