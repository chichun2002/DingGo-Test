<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Quotes Model
 *
 * @property \App\Model\Table\CarsTable&\Cake\ORM\Association\BelongsTo $Cars
 *
 * @method \App\Model\Entity\Quote newEmptyEntity()
 * @method \App\Model\Entity\Quote newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Quote> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Quote get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Quote findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Quote patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Quote> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Quote|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Quote saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Quote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Quote>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Quote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Quote> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Quote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Quote>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Quote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Quote> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class QuotesTable extends Table
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

        $this->setTable('quotes');
        $this->setDisplayField('repairer');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Cars', [
            'foreignKey' => 'car_id',
            'joinType' => 'INNER',
        ]);
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
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

        $validator
            ->scalar('repairer')
            ->maxLength('repairer', 255)
            ->requirePresence('repairer', 'create')
            ->notEmptyString('repairer');

        $validator
            ->scalar('overview_of_work')
            ->requirePresence('overview_of_work', 'create')
            ->notEmptyString('overview_of_work');

        $validator
            ->integer('car_id')
            ->notEmptyString('car_id');

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
        $rules->add($rules->existsIn(['car_id'], 'Cars'), ['errorField' => 'car_id']);

        return $rules;
    }
}
