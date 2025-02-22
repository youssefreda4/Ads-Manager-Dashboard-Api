<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Models\User;
use App\Helper\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\AdminResource;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            $data = $request->validated();
            $user = User::create($data);
            $token = $user->createToken('API-TOKEN')->plainTextToken;

            return ApiResponse::sendResponse(201, 'User Account Created Successfully', [
                'token' => $token,
                'user' => new UserResource($user),
            ]);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(500, 'Something went wrong', ['error' => $e->getMessage()]);
        }
    }

    public function login(LoginRequest $request)
    {
        try {

            $data = $request->validated();

            if (Auth::guard('web')->attempt($data)) {
                $user = Auth::guard('web')->user();
                $token = $user->createToken('API-TOKEN')->plainTextToken;

                return ApiResponse::sendResponse(200, 'User Loggen in Successfully', [
                    'token' => $token,
                    'user' => new UserResource($user),
                ]);
            }
            if (Auth::guard('admin')->attempt($data)) {
                $admin = Auth::guard('admin')->user();
                $token = $admin->createToken('API-TOKEN-ADMIN')->plainTextToken;

                return ApiResponse::sendResponse(200, 'Admin Loggen in Successfully', [
                    'token' => $token,
                    'admin' => new AdminResource($admin),
                ]);
            }


            return ApiResponse::sendResponse(401, 'User Credentials doesn\'t exist');
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(500, 'Something went wrong', ['error' => $e->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ApiResponse::sendResponse(200, 'loggen Out Successfully');
    }
}
