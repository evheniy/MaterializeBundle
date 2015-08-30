<?php

namespace Evheniy\MaterializeBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class MaterializeExtension
 *
 * @package Evheniy\MaterializeBundle\Twig
 */
class MaterializeExtension extends \Twig_Extension
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return array
     */
    public function getGlobals()
    {
        return array(
            'materialize' => $this->container->getParameter('materialize')
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'materialize';
    }
}
