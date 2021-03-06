<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Commodities Model
 *
 * @property \App\Model\Table\EnterpriseCommoditiesTable&\Cake\ORM\Association\HasMany $EnterpriseCommodities
 * @property \App\Model\Table\ActorsTable&\Cake\ORM\Association\BelongsToMany $Actors
 * @property \App\Model\Table\OrganisationsTable&\Cake\ORM\Association\BelongsToMany $Organisations
 *
 * @method \App\Model\Entity\Commodity newEmptyEntity()
 * @method \App\Model\Entity\Commodity newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Commodity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Commodity get($primaryKey, $options = [])
 * @method \App\Model\Entity\Commodity findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Commodity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Commodity[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Commodity|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Commodity saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Commodity[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Commodity[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Commodity[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Commodity[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CommoditiesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('commodities');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('EnterpriseCommodities', [
            'foreignKey' => 'commodity_id',
        ]);
        $this->belongsToMany('Actors', [
            'foreignKey' => 'commodity_id',
            'targetForeignKey' => 'actor_id',
            'joinTable' => 'actors_commodities',
        ]);
        $this->belongsToMany('Organisations', [
            'foreignKey' => 'commodity_id',
            'targetForeignKey' => 'organisation_id',
            'joinTable' => 'organisations_commodities',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }
}
