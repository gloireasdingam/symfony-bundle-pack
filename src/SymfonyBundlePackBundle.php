<?php

namespace TonVendor\SymfonyBundlePack;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Classe principale du bundle.
 * Enregistrée automatiquement dans config/bundles.php par Symfony Flex.
 */
class SymfonyBundlePackBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return null; // Pas de configuration propre, on délègue aux bundles tiers
    }

    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
    }
}
