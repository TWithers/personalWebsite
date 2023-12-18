<?php

namespace App\Lib\Sdk\Tuya;

use App\Lib\Sdk\Tuya\Resources\AuthResource;
use App\Lib\Sdk\Tuya\Resources\DeviceResource;
use Saloon\Contracts\Authenticator;
use Saloon\Http\Connector;

class TuyaConnector extends Connector
{
    protected ?string $token = null;

    public function __construct(
        protected readonly string $clientId,
        protected readonly string $clientSecret,
        protected readonly string $baseUrl = 'https://openapi.tuyaus.com',
    ) {
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function resolveBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function defaultAuth(): ?Authenticator
    {
        return new TuyaAuthenticator($this->clientId, $this->clientSecret, $this->token);
    }

    public function auth(): AuthResource
    {
        return new AuthResource($this);
    }

    public function devices(): DeviceResource
    {
        return new DeviceResource($this);
    }
}
