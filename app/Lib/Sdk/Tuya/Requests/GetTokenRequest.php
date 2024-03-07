<?php

namespace App\Lib\Sdk\Tuya\Requests;

use App\Lib\Sdk\Tuya\Responses\AccessToken;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetTokenRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * {@inheritDoc}
     */
    public function resolveEndpoint(): string
    {
        return '/v1.0/token?grant_type=1';
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();

        return new AccessToken(
            accessToken: $data['result']['access_token'],
            expireTime: $data['result']['expire_time'],
            refreshToken: $data['result']['refresh_token'],
            uid: $data['result']['uid'],
        );
    }
}
