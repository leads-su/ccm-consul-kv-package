<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit;

use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Consul\KeyValue\ConsulKeyValueDomain;

/**
 * Class ConsulKeyValueDomainTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit
 */
class ConsulKeyValueDomainTest extends TestCase
{
    /**
     * @return void
     */
    public function testMigrationsShouldRunByDefault(): void
    {
        $this->assertTrue(ConsulKeyValueDomain::shouldRunMigrations());
    }

    /**
     * @return void
     */
    public function testMigrationsPublishingCanBeDisabled(): void
    {
        ConsulKeyValueDomain::ignoreMigrations();
        $this->assertFalse(ConsulKeyValueDomain::shouldRunMigrations());
        ConsulKeyValueDomain::registerMigrations();
    }

    /**
     * @return void
     */
    public function testRoutesShouldNotBeRegisteredByDefault(): void
    {
        ConsulKeyValueDomain::ignoreRoutes();
        $this->assertFalse(ConsulKeyValueDomain::shouldRegisterRoutes());
        ConsulKeyValueDomain::registerRoutes();
    }

    /**
     * @return void
     */
    public function testRoutesRegistrationCanBeEnabled(): void
    {
        ConsulKeyValueDomain::registerRoutes();
        $this->assertTrue(ConsulKeyValueDomain::shouldRegisterRoutes());
        ConsulKeyValueDomain::ignoreRoutes();
    }
}
