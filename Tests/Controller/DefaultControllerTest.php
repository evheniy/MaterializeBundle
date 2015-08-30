<?php
namespace Evheniy\MaterializeBundle\Tests\Controller;

use Assetic\Extension\Twig\AsseticExtension;
use Assetic\Factory\AssetFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Evheniy\MaterializeBundle\Twig\MaterializeExtension;
use Evheniy\MaterializeBundle\DependencyInjection\MaterializeExtension as MaterializeExtensionDI;

/**
 * Class DefaultControllerTest
 *
 * @package Evheniy\MaterializeBundle\Tests\Controller
 */
class DefaultControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    protected function getTwig(array $data)
    {
        $twig = new \Twig_Environment(
            new \Twig_Loader_Array(
                array('MaterializeBundle:Materialize:js.html.twig' => file_get_contents(dirname(__FILE__) . '/../../Resources/views/Materialize/js.html.twig'))
            )
        );
        $container = new ContainerBuilder();
        $extension = new MaterializeExtensionDI();
        $extension->load($data, $container);
        $twig ->addExtension(new AsseticExtension(new AssetFactory(dirname(__FILE__) . '/')));
        $twig ->addExtension(new MaterializeExtension($container));

        return $twig;
    }

    /**
     *
     */
    public function testWithCdn()
    {
        $html = $this->getTwig(array(array('local_cdn' => 'cdn.site.com')))->render('MaterializeBundle:Materialize:js.html.twig');
        $this->assertRegExp('/href\=\"\/\/cdn\.site\.comcss\/materialize.min.css\"/', $html);
        $this->assertRegExp('/src\=\"\/\/cdn\.site\.comjs\/materialize.min.js\"/', $html);
    }

    /**
     *
     */
    public function testWithOutCdn()
    {
        $html = $this->getTwig(array(array()))->render('MaterializeBundle:Materialize:js.html.twig');
        $this->assertRegExp('/href\=\"css\/materialize.min.css\"/', $html);
        $this->assertRegExp('/src\=\"js\/materialize.min.js\"/', $html);
    }
}