<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Models\Message;
use App\Helper\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\MessageRequest;
use App\Http\Resources\MessageResource;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageRequest $request)
    {
        $data = $request->validated();
        $message = Message::create($data);
        if (!$message) {
            return ApiResponse::sendResponse(200, 'Failed send message');
        }
        return ApiResponse::sendResponse(201, 'Message send successfully', new MessageResource($message));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
