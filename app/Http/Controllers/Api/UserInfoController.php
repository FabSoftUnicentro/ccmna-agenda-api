<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Enums\Version;
use App\Http\Resources\v1_0\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class UserInfoController extends Controller
{
    public function __invoke(Request $request, Version $version): UserResource
    {
        abort_unless(
            $version->greaterThanOrEqualsTo(Version::v1_0),
            Response::HTTP_NOT_FOUND
        );

        return UserResource::make($request->user());
    }
}
