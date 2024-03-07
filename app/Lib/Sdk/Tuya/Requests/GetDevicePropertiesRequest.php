<?php

namespace App\Lib\Sdk\Tuya\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetDevicePropertiesRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected string $deviceId,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function resolveEndpoint(): string
    {
        return '/v2.0/cloud/thing/'.$this->deviceId.'/shadow/properties';
    }
}
