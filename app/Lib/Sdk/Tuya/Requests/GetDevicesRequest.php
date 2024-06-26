<?php

namespace App\Lib\Sdk\Tuya\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetDevicesRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * {@inheritDoc}
     */
    public function resolveEndpoint(): string
    {
        return '/v2.0/cloud/thing/device';
    }

    protected function defaultQuery(): array
    {
        return [
            'page_size' => 20,
        ];
    }
}
