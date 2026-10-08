<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Client;
use Cake\Collection\Collection;
function getCredentials(): array
{
    return ['username' => env('USERNAME'), 'key' => env('KEY'),];
}
const API_URL = 'https://app.dev.aws.dinggo.com.au/phptest/';


/**
 * Requests Controller
 *
 */
class RequestsController extends AppController
{
    public function test(): void
    {
        $client = new Client();

        $response = $client->get(API_URL . 'test');

        debug($response);
    }
    public function testcreds(): void
    {
        $client = new Client();

        $response = $client->post(API_URL . 'testcreds', getCredentials());

        debug($response->getStringBody());
    }
}
