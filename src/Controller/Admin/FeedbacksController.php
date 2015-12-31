<?php

namespace AkkaFeedback\Controller\Admin;

use App\Controller\Admin\AdminsController;

/**
 * Feedbacks Controller
 *
 * @property \AkkaFeedback\Model\Table\FeedbacksTable $Feedbacks
 */
class FeedbacksController extends AdminsController {

  public $paginate = [
      'limit' => 25,
      'order' => [
          'Feedbacks.created' => 'desc',
          'Feedbacks.viewed' => 'asc'
      ]
  ];

  public function initialize() {
    parent::initialize();
    $this->loadComponent('RequestHandler');
  }

  /**
   * Index method
   *
   * @return void
   */
  public function index() {
    $this->set('feedbacks', $this->paginate($this->Feedbacks));
    $this->set('_serialize', ['feedbacks']);
  }

  /**
   * View method
   *
   * @param string|null $id Feedback id.
   * @return void
   * @throws \Cake\Network\Exception\NotFoundException When record not found.
   */
  public function view($id = null) {
    $feedback = $this->Feedbacks->get($id, [
        'contain' => []
    ]);

    if ($feedback) {
      $this->_markViewed($feedback);
    }

    $this->set('feedback', $feedback);
    $this->set('_serialize', ['feedback']);
  }

  /**
   * Delete method
   *
   * @param string|null $id Feedback id.
   * @return \Cake\Network\Response|null Redirects to index.
   * @throws \Cake\Network\Exception\NotFoundException When record not found.
   */
  public function delete($id = null) {
    $this->request->allowMethod(['post', 'delete']);
    $feedback = $this->Feedbacks->get($id);
    if ($this->Feedbacks->delete($feedback)) {
      $this->Flash->success(__('The feedback has been deleted.'));
    } else {
      $this->Flash->error(__('The feedback could not be deleted. Please, try again.'));
    }
    return $this->redirect(['action' => 'index']);
  }

  protected function _markViewed($feedback) {

    $data['viewed'] = 1;

    $feedback = $this->Feedbacks->patchEntity($feedback, $data);

    if ($this->Feedbacks->save($feedback)) {
      return true;
    } else {
      return false;
    }
  }

}
