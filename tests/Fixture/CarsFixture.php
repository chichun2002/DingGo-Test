<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CarsFixture
 */
class CarsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'license_plate' => 'Lorem i',
                'license_state' => 'L',
                'vin' => 'Lorem ipsum dol',
                'year' => 1,
                'colour' => 'Lorem ipsum dolor sit amet',
                'make' => 'Lorem ipsum dolor sit amet',
                'model' => 'Lorem ipsum dolor sit amet',
                'created' => '2026-10-07 09:18:54',
                'modified' => '2026-10-07 09:18:54',
            ],
        ];
        parent::init();
    }
}
