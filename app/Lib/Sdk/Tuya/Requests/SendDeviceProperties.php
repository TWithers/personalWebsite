<?php

namespace App\Lib\Sdk\Tuya\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class SendDeviceProperties extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected string $deviceId,
        protected array $properties,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function resolveEndpoint(): string
    {
        return '/v2.0/cloud/thing/'.$this->deviceId.'/shadow/properties/issue';
    }

    protected function defaultBody(): array
    {
        return [
            'properties' => $this->properties,
        ];
    }
}
