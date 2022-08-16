<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Api\AuthTokenRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

final class AuthTokenController extends Controller
{
    public function __invoke(AuthTokenRequest $request, AuthService $authService): JsonResponse
    {
        $data = $request->validated();

        $token = $authService->authenticate(
            $data['email'],
            $data['password'],
            $data['token_name']
        );

        return response()->json(['token' => $token], Response::HTTP_CREATED);
    }
}
