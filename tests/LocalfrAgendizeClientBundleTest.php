<?php

namespace Localfr\AgendizeClientBundle\Tests;

use Localfr\AgendizeClientBundle\DependencyInjection\LocalfrAgendizeClientBundleExtension;
use Localfr\AgendizeClientBundle\LocalfrAgendizeClientBundle;

class LocalfrAgendizeClientBundleTest extends TestCase
{
    public function testShouldReturnNewContainerExtension()
    {
        $testBundle = new LocalfrAgendizeClientBundle();

        $result = $testBundle->getContainerExtension();
        $this->assertInstanceOf(LocalfrAgendizeClientBundleExtension::class, $result);
    }
}