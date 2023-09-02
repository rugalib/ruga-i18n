<?php
/*
 * SPDX-FileCopyrightText: 2023 Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 * SPDX-License-Identifier: AGPL-3.0-only
 */

declare(strict_types=1);

namespace Ruga\I18n;

use Ruga\I18n\Command\UpdateMoCommand;
use Ruga\I18n\Command\UpdatePoCommand;
use Ruga\I18n\Command\UpdatePotCommand;
use Ruga\I18n\Container\Command\CommandFactory;

/**
 * Class ConfigProvider
 *
 * @author Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 */
class ConfigProvider
{
    public function __invoke()
    {
        return [
            Localization::class => [
                Localization::LOCALE_DEFAULT => 'de_CH', // Default locale
                Localization::LOCALE_ATTRIBUTE_NAME => 'locale',
                Localization::LANGUAGE_DEFAULT => 'deu', // Default language (ISO639 3-Letter-Code)
                Localization::LANGUAGE_ATTRIBUTE_NAME => 'language',
                Localization::LANGUAGES => [],
                Localization::GETTEXT_POT => 'data/language/messages.pot',
                Localization::GETTEXT_SRC_DIRS => ['src'],
                Localization::GETTEXT_PO_DIR => 'data/language',
                Localization::GETTEXT_MO_DIR => 'data/language/compiled',
                Localization::GETTEXT_SRC_LANG => 'deu',
            ],
            
            'dependencies' => [
                'factories' => [
                    // Middleware
                    LocalizationMiddleware::class => Container\LocalizationMiddlewareFactory::class,
                    
                    // Commands
                    UpdatePotCommand::class => CommandFactory::class,
                    UpdatePoCommand::class => CommandFactory::class,
                    UpdateMoCommand::class => CommandFactory::class,
                ],
                'aliases' => [
                    LocalizationInterface::class => Localization::class,
                ],
                'invokables' => [
                    Localization::class => Localization::class,
                ],
            ],
            
            'view_helpers' => [
                'aliases' => [
                    'localization' => Helper\LocalizationViewHelper::class,
                ],
                'factories' => [
                    Helper\LocalizationViewHelper::class => Container\Helper\LocalizationViewHelperFactory::class,
                ],
            ],
            
            'laminas-cli' => [
                'commands' => [
                    'i18n:update-pot' => Command\UpdatePotCommand::class,
                    'i18n:update-po' => Command\UpdatePoCommand::class,
                    'i18n:update-mo' => Command\UpdateMoCommand::class,
                ],
            ],
        ];
    }
    
}