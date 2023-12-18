<?php

namespace App\Http\Controllers;

use App\Lib\Sdk\Tuya\TuyaConnector;
use Illuminate\Http\Request;

class GithubWebhookController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $api = app(TuyaConnector::class);
        $api->auth()->getToken();
        $api->devices()->sendProperties(config('services.tuya.deviceId'), ['manual_feed' => 1]);

        return response()->json(['message' => 'ok']);
    }
}
