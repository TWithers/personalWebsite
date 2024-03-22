<?php

namespace App\Lib\Sdk\Tuya\Resources;

use App\Lib\Sdk\Tuya\Requests\GetDevicePropertiesRequest;
use App\Lib\Sdk\Tuya\Requests\GetDevicesRequest;
use App\Lib\Sdk\Tuya\Requests\SendDeviceProperties;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class DeviceResource extends BaseResource
{
    public function all(): Response
    {
        $response = $this->connector->send(new GetDevicesRequest());

        return $response;
    }

    public function sendProperties(string $deviceId, array $properties): Response
    {
        $response = $this->connector->send(new SendDeviceProperties($deviceId, $properties));

        return $response;
    }

    public function getProperties(string $deviceId): Response
    {
        $response = $this->connector->send(new GetDevicePropertiesRequest($deviceId));

        return $response;
    }
}
