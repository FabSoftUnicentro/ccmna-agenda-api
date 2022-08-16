<?php

declare(strict_types=1);

use App\Enums\Version;
use App\Models\User;
use Illuminate\Http\Response;
use function Pest\Laravel\getJson;

dataset('api_versions', [
    'v1.0' => Version::v1_0,
    'v1.1' => Version::v1_1,
    'v1.0' => Version::v2_0,
]);

it('returns the info for the given user', function (Version $version) {
    $user = User::factory()->create();

    $this->be($user, 'sanctum');

    $response = getJson(url(sprintf('api/%s/me', $version->value)))
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            'data' => [
                'uuid',
                'name',
                'email',
                'created_at',
                'updated_at',
            ],
        ]);

    expect($response->json('data.uuid'))->toBe($user->uuid->toString());
    expect($response->json('data.name'))->toBe($user->name);
    expect($response->json('data.email'))->toBe($user->email);
    expect($response->json('data.created_at'))->toBe($user->created_at->toISOString());
    expect($response->json('data.updated_at'))->toBe($user->updated_at->toISOString());
})->with('api_versions');
