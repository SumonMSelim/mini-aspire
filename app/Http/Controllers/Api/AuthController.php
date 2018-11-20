<?php

namespace App\Http\Controllers\Api;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\User;

class AuthController extends Controller
{
    public function register()
    {
        $rules = [
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ];

        $response = $this->validateWithJson(request()->all(), $rules);

        // if validation passes, create the user
        if ($response === true) {
            $data = [
                'full_name' => request()->input('full_name'),
                'email' => strtolower(request()->input('email')),
                'password' => bcrypt(request()->input('password')),
                'signup_role' => request()->input('signup_role'),
                'signup_looking_for' => request()->input('signup_looking_for'),
                'heard_through' => request()->input('heard_through'),
            ];

            try {
                $user = User::create($data);
                event(new UserRegistered($user));

                return $this->respondWithSuccess('Registration successful.', ['user' => UserResource::make($user)]);
            } catch (\Exception $exception) {
                return $this->respondWithError($exception->getMessage());
            }
        }

        return $this->respondWithError('Data validation failed.', $response);
    }
}
