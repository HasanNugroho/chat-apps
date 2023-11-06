<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Services\ChatService;
use App\Http\Requests\StoreChatRequest;

class ChatController extends BaseController
{
    protected ChatService $chatService;

    public function __construct(ChatService $chatService) {
        $this->chatService = $chatService;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(string $token, StoreChatRequest $request)
    {
        $data = $request->all();
        try {
            $store = $this->chatService->sendMessage($token, $data);
            return $this->sendResponse(200, 'Send message successfully.', $store);
        } catch (\Throwable $th) {
            return $this->sendError(400, 'Send message failed.', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
