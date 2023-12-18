<?php

namespace App\Lib\Sdk\Tuya;

use Saloon\Contracts\Authenticator;
use Saloon\Enums\Method;
use Saloon\Http\PendingRequest;

class TuyaAuthenticator implements Authenticator
{
    public function __construct(
        protected readonly string $clientId,
        protected readonly string $clientSecret,
        protected readonly ?string $token,
    ) {
    }

    public function set(PendingRequest $pendingRequest): void
    {
        $timestamp = round(microtime(true) * 1000);
        $pendingRequest->headers()->add('t', $timestamp);
        $pendingRequest->headers()->add('sign', $this->sign($timestamp, $pendingRequest));
        $pendingRequest->headers()->add('client_id', $this->clientId);
        $pendingRequest->headers()->add('sign_method', 'HMAC-SHA256');

        if ($this->token) {
            $pendingRequest->headers()->add('access_token', $this->token);
        }
    }

    protected function sign(int $timestamp, PendingRequest $request): string
    {
        $method = $request->getMethod()->value;
        $content = hash('sha256', $method === Method::GET->value ? '' : json_encode($request->body()->all()));
        $headers = ''; //$request->headers()->all();
        $url = $request->getRequest()->resolveEndpoint();
        if ($request->query()->isNotEmpty()) {
            $url .= '?' . http_build_query($request->query()->all());
        }

        $arrayToSign = [$method, $content, $headers, $url];
        $stringToSign = implode("\n", $arrayToSign);
        $toSign = $this->clientId . $this->token . $timestamp . $stringToSign;

        return strtoupper(hash_hmac('sha256', $toSign , $this->clientSecret));
    }
}
