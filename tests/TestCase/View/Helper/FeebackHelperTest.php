<?php
namespace AkkaFeedback\Test\TestCase\View\Helper;

use AkkaFeedback\View\Helper\FeebackHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * AkkaFeedback\View\Helper\FeebackHelper Test Case
 */
class FeebackHelperTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Feeback = new FeebackHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Feeback);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
