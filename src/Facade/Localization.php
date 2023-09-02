<?php
/*
 * SPDX-FileCopyrightText: 2023 Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 * SPDX-License-Identifier: AGPL-3.0-only
 */

declare(strict_types=1);

namespace Ruga\I18n\Facade;

use Laminas\I18n\Translator\TranslatorInterface;
use Ruga\I18n\LocalizationInterface;
use Ruga\Std\Facade\AbstractFacade;

/**
 * Class Localization
 *
 * @method static string getLanguage(string $key = null)
 */
abstract class Localization extends AbstractFacade
{
    
    /**
     * Get the name of the component for the concrete facade.
     * Override this function in every concrete facade.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeInstanceName(): string
    {
        return LocalizationInterface::class;
    }
    
    
    
    /**
     * Return the TranslatorInterface instance.
     *
     * @return TranslatorInterface
     */
    public static function getTranslator(): TranslatorInterface
    {
        return self::$controller->get(TranslatorInterface::class);
    }
}