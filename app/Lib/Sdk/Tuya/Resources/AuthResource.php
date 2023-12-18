<?php

namespace App\Lib\Sdk\Tuya\Resources;

use App\Lib\Sdk\Tuya\Requests\GetTokenRequest;
use App\Lib\Sdk\Tuya\Responses\AccessToken;
use Saloon\Http\BaseResource;

class AuthResource extends BaseResource
{
    public function getToken(): AccessToken
    {
        $response = $this->connector->send(new GetTokenRequest());
        $token = $response->dto();
        $this->connector->setToken($token->accessToken);

        return $token;
    }
}
