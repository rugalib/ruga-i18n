<?php

declare(strict_types=1);

namespace Ruga\I18n\Container\Command;

use Laminas\I18n\Translator\TranslatorInterface;
use Psr\Container\ContainerInterface;
use Ruga\I18n\Localization;
use Ruga\I18n\LocalizationInterface;
use Symfony\Component\Console\Command\Command;

class CommandFactory
{
    public function __invoke(ContainerInterface $container, string $resolvedName, $options): Command
    {
        $command = new $resolvedName($container->get('config') ?? []);
//        if ($container->has(LocalizationInterface::class)) {
//            $command->setLocalization($container->get(LocalizationInterface::class));
//        }

//        if ($container->has(TranslatorInterface::class)) {
//            $command->setTranslator($container->get(TranslatorInterface::class));
//        }
        
        return $command;
    }
    
}