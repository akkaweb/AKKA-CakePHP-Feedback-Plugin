<?php

namespace AkkaFeedback\Model\Table;

use AkkaFeedback\Model\Entity\Feedback;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Feedbacks Model
 *
 */
class FeedbacksTable extends Table {

  /**
   * Initialize method
   *
   * @param array $config The configuration for the Table.
   * @return void
   */
  public function initialize(array $config) {
    parent::initialize($config);

    $this->table('feedbacks');
    $this->displayField('name');
    $this->primaryKey('id');

    $this->addBehavior('Timestamp');
  }

  /**
   * Default validation rules.
   *
   * @param \Cake\Validation\Validator $validator Validator instance.
   * @return \Cake\Validation\Validator
   */
  public function validationDefault(Validator $validator) {
    $validator->add('id', 'valid', ['rule' => 'numeric'])->allowEmpty('id', 'create');
    $validator->add('email', 'valid', ['rule' => 'email'])->allowEmpty('email');
    $validator->allowEmpty('name');
    $validator->allowEmpty('feedback');
    $validator->allowEmpty('browser');
    $validator->allowEmpty('uri');
    $validator->allowEmpty('ip');
    $validator->allowEmpty('referrer');
    $validator->allowEmpty('viewed');

    return $validator;
  }

}
