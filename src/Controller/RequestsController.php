<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Client;
use Cake\Collection\Collection;

const CREDENTIALS = ['username' => 'tfischerdev@gmail.com', 'key' => 'tfischerdev',];


/**
 * Requests Controller
 *
 */
class RequestsController extends AppController
{
    public function test(): void
    {
        $client = new Client();

        $response = $client->get("https://app.dev.aws.dinggo.com.au/phptest/test");

        debug($response);
    }
    public function testcreds(): void
    {
        $client = new Client();

        $response = $client->post("https://app.dev.aws.dinggo.com.au/phptest/testcreds", CREDENTIALS);

        debug($response->getStringBody());
    }

    public function cars(): void
    {
        $client = new Client();

        $response = $client->post("https://app.dev.aws.dinggo.com.au/phptest/cars", CREDENTIALS);

        debug($response->getStringBody());

        $json = $response->getJson()['cars'];

        debug($json);

        if (!is_array($json)) {
            debug('Malformed Data');
        }

        $collection = new Collection($json);

        $collection->each(function ($car) {
            Self::quotes($car['license_plate'], $car['license_state']);
        });
    }

    public function quotes($license_plate, $license_state): void
    {
        $client = new Client();

        $response = $client->post("https://app.dev.aws.dinggo.com.au/phptest/quotes", CREDENTIALS + [
            'license_plate' => $license_plate,
            'license_state' => $license_state,
        ]);

        debug($response->getStringBody());
    }
}
