<?php

namespace Localfr\AgendizeClientBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class LocalfrAgendizeClientBundleExtension extends Extension
{
    public const EXTENSION_ALIAS = 'localfr_agendize';

    /**
     * {@inheritdoc}
     */
    public function getAlias(): string
    {
        return self::EXTENSION_ALIAS;
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yaml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $container->setParameter('localfr_agendize.api_key', $config['api_key']);
        $container->setParameter('localfr_agendize.api_token', $config['api_token']);
        $container->setParameter('localfr_agendize.api_version', $config['api_version']);
    }
}
