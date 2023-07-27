<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;

class CaloriesBurnedController extends Controller
{
public function getCaloriesBurned(Request $request)
{
    $activity = $request->input('activity');

    if (empty($activity)) {
        return redirect()->back()->withInput()->withErrors('Please provide an activity.');
    }

    $apiKey = env('API_KEY');
    $apiHost = env('API_HOST');

    $client = new Client([
        'base_uri' => "https://$apiHost/v1/",
        'headers' => [
            'X-Rapidapi-Key' => $apiKey,
            'X-Rapidapi-Host' => $apiHost,
        ],
    ]);

    $response = $client->get("caloriesburned?activity=$activity");
    $data = $response->getBody()->getContents();

    // Process the response data as needed
    $result = json_decode($data, true);

    // Assuming the response data has a 'calories_burned' key
    $caloriesBurned = $result['calories_burned'];

    return view('user.calories-burned', ['caloriesBurned' => $caloriesBurned, 'activity' => $activity]);
}

}
