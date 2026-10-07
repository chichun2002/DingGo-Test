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

    protected function cars(): array
    {
        $client = new Client();

        $response = $client->post("https://app.dev.aws.dinggo.com.au/phptest/cars", CREDENTIALS);

        $json = $response->getJson()['cars'];

        if (!\is_array($json)) {
            debug('Malformed Data');
            return [];
        }

        return $json;
    }

    protected function quotes($license_plate, $license_state): array
    {
        $client = new Client();

        $response = $client->post("https://app.dev.aws.dinggo.com.au/phptest/quotes", CREDENTIALS + [
            'license_plate' => $license_plate,
            'license_state' => $license_state,
        ]);

        $json = $response->getJson()['quotes'];

        if (!\is_array($json)) {
            debug('Malformed Data');
            return [];
        }

        return $json;
    }

    public function update(): void
    {
        $cars = $this->cars();

        $cars_table = $this->fetchTable('Cars');
        $quotes_table = $this->fetchTable('Quotes');

        foreach ($cars as $car) {
            $existing_car = $cars_table->find()
                ->where(['vin' => $car['vin']])
                ->first();

            $new_car = $existing_car
                ? $cars_table->patchEntity($existing_car, $car)
                : $cars_table->newEntity($car);

            if (!$cars_table->save($new_car)) {
                debug($new_car->getErrors());
                continue;
            }

            $quotes = $this->quotes($new_car->license_plate, $new_car->license_state);
            if (!$quotes) {
                continue;
            }

            $quotes = collection($quotes)
                ->map(fn ($quote) => [...$quote, 'car_id' => $new_car->id])
                ->toList();

            $new_quotes = $quotes_table->newEntities($quotes);
            $errors = collection($new_quotes)
                ->filter(fn ($quote) => $quote->hasErrors())
                ->map(fn ($quote) => $quote->getErrors())
                ->toList();

            if ($errors) {
                debug($errors);
                continue;
            }

            $quotes_table->getConnection()->transactional(function () use ($quotes_table, $new_car, $new_quotes) {
                $quotes_table->deleteAll(['car_id' => $new_car->id]);

                return $quotes_table->saveMany($new_quotes) !== false;
            });
        }
    }
}
