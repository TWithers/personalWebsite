<?php

namespace App\Lib\Sdk\Tuya\Responses;

use Saloon\Contracts\DataObjects\WithResponse;
use Saloon\Traits\Responses\HasResponse;

class AccessToken implements WithResponse
{
    use HasResponse;

    public function __construct(
        public string $accessToken,
        public int $expireTime,
        public string $refreshToken,
        public string $uid,
    ) {
    }
}
