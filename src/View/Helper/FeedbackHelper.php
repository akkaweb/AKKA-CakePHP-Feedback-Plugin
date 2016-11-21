<?php

/**
 * Feedback Helper
 */

namespace AkkaFeedback\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\Core\Configure;

/**
 * Feeback helper
 */
class FeedbackHelper extends Helper
{
    public $helpers = ['Html', 'Form'];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'feedback_element' => '#akka-feedback',
        'toggle' => '#akka-feedback-toggle',
        'exit_selector' => '.close-feedback',
        'animation_duration' => '0.5s',
        'place' => 'right',
        'animation_curve' => 'cubic-bezier(0.54, 0.01, 0.57, 1.03)',
        'body_slide' => true,
        'no_scroll' => true
    ];

    /**
     * Merged configuration
     *
     * @var type array
     */
    protected $_configs = [];

    /**
     * Construct
     *
     * @param View $view
     * @param type $config
     */
    public function __construct(View $view, $config = [])
    {
        parent::__construct($view, $config);
        $this->_configs = $this->config();

        $this->_writeBuffer();
    }

    public function _writeBuffer()
    {

        $settings = <<<EOF
    var settings = {
            toggle: "{$this->_configs['toggle']}",
            exit_selector: "{$this->_configs['exit_selector']}",
            animation_duration: "{$this->_configs['animation_duration']}",
            place: "{$this->_configs['place']}",
            animation_curve: "{$this->_configs['animation_curve']}",
            body_slide: {$this->_configs['body_slide']},
            no_scroll: {$this->_configs['no_scroll']}
    };


    $(document).ready(function(){
      $('{$this->_configs['feedback_element']}').sliiide(settings);
    });

EOF;
        $this->Html->css('AkkaFeedback.feedback.css', ['block' => true]);
        $this->Html->script('AkkaFeedback.sliiide/sliiide.min.js', ['block' => true]);
        $this->Html->script('AkkaFeedback.feedback.js', ['block' => true]);
        $this->Html->scriptBlock($settings, ['block' => true]);
    }

    /**
     * Add reCaptcha to the form
     * @return mixed
     */
    public function addReCaptcha()
    {
        if (!Configure::read('Feedbacks.reCaptcha.key')) {
            return $this->Html->tag('p', 'reCaptcha is not configured! See Docs!');
        }
        $this->addReCaptchaScript();
        $this->Form->unlockField('g-recaptcha-response');

        return $this->Html->tag('div', '', [
                'class' => 'g-recaptcha',
                'data-sitekey' => Configure::read('Feedbacks.reCaptcha.key')
        ]);
    }

    /**
     * Add reCaptcha script
     * @return void
     */
    public function addReCaptchaScript()
    {
        $this->Html->script('https://www.google.com/recaptcha/api.js', [
            'block' => 'script',
        ]);
    }
}