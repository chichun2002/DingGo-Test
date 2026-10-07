<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cars Model
 *
 * @method \App\Model\Entity\Car newEmptyEntity()
 * @method \App\Model\Entity\Car newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Car> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Car get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Car findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Car patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Car> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Car|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Car saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Car>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Car>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Car>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Car> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Car>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Car>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Car>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Car> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CarsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('cars');
        $this->setDisplayField('license_plate');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('license_plate')
            ->maxLength('license_plate', 9)
            ->requirePresence('license_plate', 'create')
            ->notEmptyString('license_plate');

        $validator
            ->scalar('license_state')
            ->maxLength('license_state', 3)
            ->requirePresence('license_state', 'create')
            ->notEmptyString('license_state');

        $validator
            ->scalar('vin')
            ->maxLength('vin', 17)
            ->requirePresence('vin', 'create')
            ->notEmptyString('vin')
            ->add('vin', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('year')
            ->requirePresence('year', 'create')
            ->notEmptyString('year');

        $validator
            ->scalar('colour')
            ->maxLength('colour', 255)
            ->requirePresence('colour', 'create')
            ->notEmptyString('colour');

        $validator
            ->scalar('make')
            ->maxLength('make', 255)
            ->requirePresence('make', 'create')
            ->notEmptyString('make');

        $validator
            ->scalar('model')
            ->maxLength('model', 255)
            ->requirePresence('model', 'create')
            ->notEmptyString('model');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['vin']), ['errorField' => 'vin']);

        return $rules;
    }
}
