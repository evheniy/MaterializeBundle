<?php

namespace Evheniy\MaterializeBundle\Tests\Twig;

use Evheniy\MaterializeBundle\Twig\MaterializeExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class MaterializeExtensionTest
 *
 * @package Evheniy\MaterializeBundle\Tests\Twig
 */
class MaterializeExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MaterializeExtension
     */
    private $extension;
    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     *
     */
    protected function setUp()
    {
        $this->container = new ContainerBuilder();
        $this->extension = new MaterializeExtension($this->container);
    }

    /**
     * Test normal config
     */
    public function testWithId()
    {
        $this->container->setParameter('materialize', array('local_js' => 'test'));
        $this->assertTrue($this->container->hasParameter('materialize'));
        $materialize = $this->container->getParameter('materialize');
        $this->assertNotEmpty($materialize);
        $this->assertTrue(is_array($materialize));
        $this->assertNotEmpty($materialize['local_js']);
        $this->assertEquals($materialize['local_js'], 'test');
        $globals = $this->extension->getGlobals();
        $this->assertNotEmpty($globals);
        $this->assertTrue(is_array($globals));
        $this->assertNotEmpty($globals['materialize']);
        $this->assertTrue(is_array($globals['materialize']));
        $this->assertNotEmpty($globals['materialize']['local_js']);
        $this->assertEquals($globals['materialize']['local_js'], 'test');
    }

    /**
     * Test empty config
     */
    public function testWithOutLocal()
    {
        $this->assertFalse($this->container->hasParameter('materialize'));
        $this->setExpectedException(
            'Exception',
            'You have requested a non-existent parameter "materialize".'
        );
        $this->assertNotEmpty($this->extension->getGlobals());
    }

    /**
     * Test getName()
     */
    public function testGetName()
    {
        $this->assertEquals($this->extension->getName(), 'materialize');
    }
} 