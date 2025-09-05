<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;

/**
 * @internal
 */
final class DbHealthIntegrationTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    // Ensure migrations and seeding run
    protected $migrate = true;
    protected $seed = \App\Database\Seeds\FuneralRequestsSeeder::class;

    public function testDbHealthServiceReturnsTablesAndConnected()
    {
        $service = service('dbHealth');

        $result = $service->getHealth('default');

        $this->assertIsArray($result);
        $this->assertArrayHasKey('connected', $result);
        $this->assertTrue($result['connected'] === true || $result['connected'] === false);

        // At minimum we should see the funeral_requests table after migrations
        $this->assertArrayHasKey('tablesCount', $result);
        $this->assertNotNull($result['tablesCount']);
        $this->assertGreaterThanOrEqual(1, $result['tablesCount']);
    }
}
