<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\RequestsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\RequestsController Test Case
 *
 * @link \App\Controller\RequestsController
 */
class RequestsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Requests',
    ];
}
