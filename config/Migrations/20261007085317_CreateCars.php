<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateCars extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/5/guides/writing-migrations/migration-methods.html#the-change-method
     *
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('cars');
        $table->addColumn('license_plate', 'string', [
            'default' => null,
            'limit' => 9,
            'null' => false,
        ]);
        $table->addColumn('license_state', 'string', [
            'default' => null,
            'limit' => 3,
            'null' => false,
        ]);
        $table->addColumn('vin', 'string', [
            'default' => null,
            'limit' => 17,
            'null' => false,
        ]);
        $table->addColumn('year', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('colour', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('make', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('model', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addIndex(['vin'], ['unique' => true]);
        $table->addIndex(['license_plate', 'license_state']);
        $table->create();
    }
}
