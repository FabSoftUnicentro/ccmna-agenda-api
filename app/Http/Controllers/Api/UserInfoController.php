<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\v1_0\UserResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserInfoController extends Controller
{
    public function __invoke(Request $request): UserResource
    {
        return UserResource::make($request->user());
    }
}
