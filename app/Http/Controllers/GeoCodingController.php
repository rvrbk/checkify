<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class GeoCodingController extends Controller
{
    public function index(Request $request, string $query)
    {
        $client = new Client();

        try {
            $response = $client->get('https://api.maptiler.com/geocoding/' . $query . '.json?key=' . env('MAPTILER_KEY'));
        
            if ((int)$response->getStatusCode() === 200) {
                return json_decode($response->getBody()->getContents());
            }
        }
        catch (ClienrException $e) {}
    }
}
