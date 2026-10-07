<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Car Entity
 *
 * @property int $id
 * @property string $license_plate
 * @property string $license_state
 * @property string $vin
 * @property int $year
 * @property string $colour
 * @property string $make
 * @property string $model
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 */
class Car extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'license_plate' => true,
        'license_state' => true,
        'vin' => true,
        'year' => true,
        'colour' => true,
        'make' => true,
        'model' => true,
        'created' => true,
        'modified' => true,
    ];
}
