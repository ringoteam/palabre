<?php

namespace Palabre\Bundle\ProjectBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

class PalabreProjectExtension extends Extension
{
    /**
     * Load configuration of Bundle
     * 
     * @param array $configs Configuration parameters
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     * @throws \InvalidArgumentException
     */
    public function load(array $configs, ContainerBuilder $container)
    {
         $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
         $loader->load('orm.xml');
         $loader->load('manager.xml');
    }

    /**
     * 
     * @return string Extension's alias
     */
    public function getAlias()
    {
        return 'palabre_project';
    }
}