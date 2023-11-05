<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Services\RoomService;
use Illuminate\Http\Request;
use App\Http\Room;

class RoomController extends BaseController
{
    protected RoomService $roomService;

    public function __construct(RoomService $roomService) {
        $this->roomService = $roomService;
    }

    public function getRooms() {
        $room = $this->roomService->getRooms(Auth::user()->id);
        
        return response()->json($room, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomRequest $request)
    {
        if ($request['type'] == Room::ROOM_GROUP_TYPE && !isset($request['name'])) {
            return $this->sendError(400, 'Create room failed.', 'name is required');
        }
        
        $data = $request->all();
        try {
            $store = $this->roomService->store($data);
            $result = [
                'roomId' => $store->id
            ];
            
            return $this->sendResponse(200, 'Create room successfully.', $result);
        } catch (\Throwable $th) {
            return $this->sendError(400, 'Create room failed.', $th->getMessage());
        }
    }
}
