<?php
namespace Neton\DirectBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Resource\FileResource;

/**
 * DirectExtension is an extension for the ExtDirect.
 *
 * @author Otavio Fernandes <otavio@neton.com.br>
 */
class DirectExtension extends Extension
{
    /**
     * Loads the API configuration.
     *
     * @param array $config An array of configuration settings
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    public function apiLoad(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, __DIR__.'/../Resources/config');
        $loader->load('direct.xml');

        foreach ($configs as $config) {
            $this->registerApiConfiguration($config, $container);
        }
    }

    /**
     * Loads the api configuration.
     *
     * @param array            $config    An array of configuration settings
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    protected function registerApiConfiguration($config, ContainerBuilder $container)
    {
        if (isset($config['url'])) {
            $container->setParameter('direct.api.url', $config['url']);
        }

        if (isset($config['type'])) {
            $container->setParameter('direct.api.type', $config['type']);
        }

        if (isset($config['namespace'])) {
            $container->setParameter('direct.api.namespace', $config['namespace']);
        }

        if (isset($config['id'])) {
            $container->setParameter('direct.api.id', $config['id']);
        }

        if (isset($config['remote_attribute'])) {
            $container->setParameter('direct.api.remote_attribute', $config['remote_attribute']);
        }

        if (isset($config['form_attribute'])) {
            $container->setParameter('direct.api.form_attribute', $config['form_attribute']);
        }

    }

    /**
     * Returns the base path for the XSD files.
     *
     * @return string The XSD base path
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    public function getNamespace()
    {
        return 'http://www.neton.com.br/schema/dic/direct';
    }

    public function getAlias()
    {
        return 'direct';
    }

}
