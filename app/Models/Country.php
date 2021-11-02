<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Country
{
    use HasFactory;

    static private function call(string $endpoint, string $method = 'get')
    {
        try {
            $client = new Client([
                'base_uri' => 'https://countriesnow.space/api/v0.1/',
                'timeout'  => 2.0,
            ]);

            return $client->request($method, $endpoint);
        }
        catch(ClientException $e) {
            throw new ClientException($e);
        }
    }

    static public function all()
    {
        return json_decode(self::call('countries/iso')->getBody()->getContents())->data;
    }
}
