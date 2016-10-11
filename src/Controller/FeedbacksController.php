<?php

namespace AkkaFeedback\Controller;

use AkkaFeedback\Controller\AppController;
use Cake\Event\Event;

/**
 * Feedbacks Controller
 *
 * @property \AkkaFeedback\Model\Table\FeedbacksTable $Feedbacks
 */
class FeedbacksController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['add']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feedback = $this->Feedbacks->newEntity();

        $this->request->data['referrer'] = $this->referer();
        $this->request->data['uri'] = $this->request->env('REQUEST_URI');
        $this->request->data['ip'] = $this->request->clientIp();
        $this->request->data['browser'] = $this->request->env('HTTP_USER_AGENT');

        if ($this->request->is('post')) {
            $feedback = $this->Feedbacks->patchEntity($feedback, $this->request->data);

            if ($this->Feedbacks->save($feedback)) {
                $event = new Event('Model.Feedbacks.afterSave', $this, ['feedback' => $feedback]);
                $this->eventManager()->dispatch($event);
            }
        }
        $this->set(compact('feedback'));
        $this->set('_serialize', ['feedback']);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function admin_index()
    {
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
    public function admin_view($id = null)
    {
        $feedback = $this->Feedbacks->get($id, [
            'contain' => []
        ]);
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
    public function admin_delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feedback = $this->Feedbacks->get($id);
        if ($this->Feedbacks->delete($feedback)) {
            $this->Flash->success(__('The feedback has been deleted.'));
        } else {
            $this->Flash->error(__('The feedback could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
