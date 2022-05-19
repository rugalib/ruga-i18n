<?php

declare(strict_types=1);

namespace Ruga\I18n\Container\Helper;

use Psr\Container\ContainerInterface;
use Ruga\I18n\Helper\LocalizationViewHelper;
use Ruga\I18n\LocalizationInterface;

class LocalizationViewHelperFactory
{
    public function __invoke(ContainerInterface $container): LocalizationViewHelper
    {
        $helper = new LocalizationViewHelper();
        if ($container->get(LocalizationInterface::class)) {
            $helper->setLocalization($container->get(LocalizationInterface::class));
        }
        return $helper;
    }
    
}