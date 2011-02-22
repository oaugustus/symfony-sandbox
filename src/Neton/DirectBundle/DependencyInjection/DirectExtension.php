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
     * Loads the Direct configuration.
     *
     * @param array $config An array of configuration settings
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    public function configLoad(array $configs, ContainerBuilder $container)
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
        if (isset($config['api']['url'])) {
            $container->setParameter('direct.api.url', $config['api']['url']);
        }

        if (isset($config['api']['type'])) {
            $container->setParameter('direct.api.type', $config['api']['type']);
        }

        if (isset($config['api']['namespace'])) {
            $container->setParameter('direct.api.namespace', $config['api']['namespace']);
        }

        if (isset($config['api']['id'])) {
            $container->setParameter('direct.api.id', $config['api']['id']);
        }

        if (isset($config['api']['remote_attribute'])) {
            $container->setParameter('direct.api.remote_attribute', $config['api']['remote_attribute']);
        }

        if (isset($config['api']['form_attribute'])) {
            $container->setParameter('direct.api.form_attribute', $config['api']['form_attribute']);
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
