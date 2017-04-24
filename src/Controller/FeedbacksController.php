<?php

namespace AkkaFeedback\Controller;

use AkkaFeedback\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;

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

            if (isset($this->request->data['recaptcha'])) {
                $this->request->data['g-recaptcha-response'] = $this->request->data['recaptcha'];
            }

            if ($this->_validateReCaptcha()) {
                if ($this->Feedbacks->save($feedback)) {
                    $event = new Event('Model.Feedbacks.afterSave', $this, ['feedback' => $feedback]);
                    $this->eventManager()->dispatch($event);

                    $this->Flash->success(__('Your message has been submitted successfully.'));
                } else {
                    $this->Flash->error(__('There was a problem submitting your message. Please try again!.'));
                }
            } else {
                $feedback['error'] = "The reCaptcha submitted is invalid. Please try again!";
                $this->Flash->error('The reCaptcha submitted is invalid. Please try again!');
            }
        }
        $this->set(compact('feedback'));
        $this->set('_serialize', ['feedback']);
    }

    /**
     * Check the POST and validate reCaptcha
     *
     */
    protected function _validateReCaptcha()
    {
        // Only validate if reCaptcha is enabled by the admin.
        if (Configure::read('Feedbacks.reCaptcha.enable')) {

            return $this->validateReCaptcha(
                    $this->request->data('g-recaptcha-response'), $this->request->clientIp()
            );
        }

        // Since reCaptcha is not enabled, true will be returned.
        return true;
    }

    /**
     * Validates reCaptcha response
     *
     * @param string $recaptchaResponse response
     * @param string $clientIp client ip
     * @return bool
     */
    public function validateReCaptcha($recaptchaResponse, $clientIp)
    {
        $recaptcha = $this->_getReCaptchaInstance();
        if (!empty($recaptcha)) {
            $response = $recaptcha->verify($recaptchaResponse, $clientIp);

            return $response->isSuccess();
        }

        return false;
    }

    /**
     * Create reCaptcha instance if enabled in configuration
     *
     * @return ReCaptcha
     */
    protected function _getReCaptchaInstance()
    {
        $reCaptchaSecret = Configure::read('Feedbacks.reCaptcha.secret');
        if (!empty($reCaptchaSecret)) {
            return new \ReCaptcha\ReCaptcha($reCaptchaSecret);
        }

        return null;
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
