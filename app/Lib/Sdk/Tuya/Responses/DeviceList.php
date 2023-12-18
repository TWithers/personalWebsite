<?php

namespace App\Lib\Sdk\Tuya\Responses;

use Saloon\Contracts\DataObjects\WithResponse;
use Saloon\Traits\Responses\HasResponse;

class DeviceList implements WithResponse, \ArrayAccess
{
    use HasResponse;

    public function __construct(
        public string $accessToken,
        public int $expireTime,
        public string $refreshToken,
        public string $uid,
    ) {
    }

    public function offsetExists(mixed $offset): bool
    {
        // TODO: Implement offsetExists() method.
    }

    public function offsetGet(mixed $offset): mixed
    {
        // TODO: Implement offsetGet() method.
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        // TODO: Implement offsetSet() method.
    }

    public function offsetUnset(mixed $offset): void
    {
        // TODO: Implement offsetUnset() method.
    }
}
