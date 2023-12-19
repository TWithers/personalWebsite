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
        $event = $request->header('x-github-event');
        $branch = $request->get('ref');

        if ($event !== 'push' && (str($branch)->endsWith('main') || str($branch)->endsWith('master'))) {
            return response()->json(['message' => 'ok', 'event' => $event, 'branch' => $branch]);
        }

//        $api = app(TuyaConnector::class);
//        $api->auth()->getToken();
//        $api->devices()->sendProperties(config('services.tuya.deviceId'), ['manual_feed' => 1]);

        return response()->json(['message' => 'ok', 'event' => $event, 'branch' => $branch]);
    }
}
