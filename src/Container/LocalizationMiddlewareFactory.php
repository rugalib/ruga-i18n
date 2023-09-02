<?php
/*
 * SPDX-FileCopyrightText: 2023 Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 * SPDX-License-Identifier: AGPL-3.0-only
 */

declare(strict_types=1);

namespace Ruga\I18n\Container;

use Laminas\I18n\Translator\TranslatorInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\MiddlewareInterface;
use Ruga\I18n\Localization;
use Ruga\I18n\LocalizationInterface;
use Ruga\I18n\LocalizationMiddleware;

class LocalizationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): MiddlewareInterface
    {
        $middleware = new LocalizationMiddleware($container->get('config')[Localization::class] ?? []);
        if ($container->has(LocalizationInterface::class)) {
            $middleware->setLocalization($container->get(LocalizationInterface::class));
        }
        
        if ($container->has(TranslatorInterface::class)) {
            $middleware->setTranslator($container->get(TranslatorInterface::class));
        }
        
        return $middleware;
    }
}