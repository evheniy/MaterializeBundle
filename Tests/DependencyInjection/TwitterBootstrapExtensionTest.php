<?php

namespace Evheniy\MaterializeBundle\Tests\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Evheniy\MaterializeBundle\DependencyInjection\MaterializeExtension;

/**
 * Class MaterializeExtensionTest
 *
 * @package Evheniy\MaterializeBundle\Tests\DependencyInjection
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
        $this->extension = new MaterializeExtension();

        $this->container = new ContainerBuilder();
        $this->container->registerExtension($this->extension);
    }

    /**
     * @param ContainerBuilder $container
     * @param string           $resource
     *
     * @return ContainerBuilder
     */
    protected function loadConfiguration(ContainerBuilder $container, $resource)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/Fixtures/'));
        $loader->load($resource . '.yml');

        return $container;
    }

    /**
     * Test empty config
     */
    public function testWithoutConfiguration()
    {
        $this->container->loadFromExtension($this->extension->getAlias())->compile();

        $materialize = $this->container->getParameter('materialize');
        $this->assertEquals($materialize['local_js'], '@MaterializeBundle/Resources/public/js/materialize.min.js');
        $this->assertEquals($this->container->getParameter('materialize.local_js'), '@MaterializeBundle/Resources/public/js/materialize.min.js');
        $this->assertEquals($materialize['local_fonts_dir'], '@MaterializeBundle/Resources/public/fonts/');
        $this->assertEquals($this->container->getParameter('materialize.local_fonts_dir'), '@MaterializeBundle/Resources/public/fonts/');
        $this->assertEquals($materialize['local_css'], '@MaterializeBundle/Resources/public/css/materialize.min.css');
        $this->assertEquals($this->container->getParameter('materialize.local_css'), '@MaterializeBundle/Resources/public/css/materialize.min.css');
        $this->assertEmpty($materialize['local_cdn']);
        $this->assertEquals($materialize['local_cdn'], '');
        $this->assertEquals($materialize['version'], '3.3.4');
        $this->assertNotEmpty($materialize['html5']);
        $this->assertTrue($materialize['html5']);
        $this->assertEmpty($materialize['async']);
        $this->assertFalse($materialize['async']);
    }

    /**
     * Test normal config
     */
    public function testTest()
    {
        $this->loadConfiguration($this->container, 'test')->compile();
        $this->assertTrue($this->container->hasParameter('materialize'));
        $this->assertTrue($this->container->hasParameter('materialize.local_js'));
        $materialize = $this->container->getParameter('materialize');
        $this->assertEquals($materialize['local_js'], $this->container->getParameter('materialize.local_js'));
        $this->assertEquals($this->container->getParameter('materialize.local_js'), 'materialize.min.js');
        $this->assertEquals($materialize['local_fonts_dir'], $this->container->getParameter('materialize.local_fonts_dir'));
        $this->assertEquals($this->container->getParameter('materialize.local_fonts_dir'), 'fonts/');
        $this->assertEquals($materialize['local_css'], $this->container->getParameter('materialize.local_css'));
        $this->assertEquals($this->container->getParameter('materialize.local_css'), 'materialize.min.css');
        $this->assertNotEmpty($materialize['local_cdn']);
        $this->assertEquals($materialize['local_cdn'], '//cdn.site.com');
        $this->assertEquals($materialize['version'], '3.3.0');
        $this->assertEmpty($materialize['html5']);
        $this->assertFalse($materialize['html5']);
        $this->assertNotEmpty($materialize['async']);
        $this->assertTrue($materialize['async']);
    }
}