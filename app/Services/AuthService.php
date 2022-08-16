<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

final class AuthService
{
    public function authenticate(string $email, string $password, string $tokenName)
    {
        /** @var User $user */
        $user = User::query()->where('email', $email)->first();

        if (! Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => [(string) trans('validation.credentials')],
            ]);
        }

        return $user
            ->createToken($tokenName)
            ->plainTextToken;
    }
}
