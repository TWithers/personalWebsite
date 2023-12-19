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

        $response = [
            'result' => 'ok',
            'event' => $event,
            'branch' => $branch,
        ];

        if ($event !== 'push' || (! str($branch)->endsWith('main') && ! str($branch)->endsWith('master'))) {
            $response['action'] = 'skip';
            $response['message'] = 'Unsupported event or branch';
            return response()->json($response);
        }

        $response['action'] = 'dispense';
        $response['message'] = '1 portion dispensed';

        $api = app(TuyaConnector::class);
        $api->auth()->getToken();
        $api->devices()->sendProperties(config('services.tuya.deviceId'), ['manual_feed' => 1]);

        return response()->json($response);
    }
}
