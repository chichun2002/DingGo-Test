<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\RequestsComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\RequestsComponent Test Case
 */
class RequestsComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\RequestsComponent
     */
    protected $Requests;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Requests = new RequestsComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Requests);

        parent::tearDown();
    }
}
