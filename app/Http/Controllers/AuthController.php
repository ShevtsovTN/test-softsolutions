<?php

namespace App\Http\Controllers;

use App\Exceptions\AppException;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @throws AppException
     */
    public function login(AuthRequest $authRequest): UserResource
    {
        if (Auth::attempt($authRequest->validated())) {
            /** @var User $user */
            $user = Auth::user();
            $token = $user->createToken('admin-access');
            return UserResource::make($user->load('roles'))->additional([
                'token' => $token->plainTextToken
            ]);
        }

        throw new AppException('User not found!', 404);
    }

    public function logout(): UserResource
    {
        /** @var User $user */
        $user = Auth::user();

        Auth::logout();

        return UserResource::make($user->load('roles'));
    }

    /**
     * @throws AppException
     */
    public function getAuthUser(): UserResource
    {
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();

            return UserResource::make($user->load('roles'));
        }

        throw new AppException('User is not authorised!', 404);
    }
}
