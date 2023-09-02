<?php
/*
 * SPDX-FileCopyrightText: 2023 Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 * SPDX-License-Identifier: AGPL-3.0-only
 */

declare(strict_types=1);

namespace Ruga\I18n;

use Ruga\I18n\Exception\LanguageNotInitializedException;

/**
 * This object is filled with data by the middleware. The object is stored in the container, where it
 * can be retrieved by the helper and the application.
 *
 * @author   Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 */
class Localization implements LocalizationInterface
{
    private array $language = [];
    
    private array $locale = [];
    
    
    
    /**
     * Set the language.
     *
     * @param string $language
     */
    public function setLanguage(string $language)
    {
        $this->language[Iso639\Key::DEFAULT] = (new \Ruga\I18n\Iso639())->find($language, Iso639\Key::DEFAULT);
    }
    
    
    
    /**
     * Return the language string as defined by $key.
     *
     * @param string|null $key A constant from Iso639\Key
     *
     * @return string
     */
    public function getLanguage(string $key = null): string
    {
        if (!$key) {
            $key = Iso639\Key::DEFAULT;
        }
        if (!($this->language[$key] ?? null)) {
            if (!($this->language[Iso639\Key::DEFAULT] ?? null)) {
                throw new LanguageNotInitializedException("Language is not set for key '" . Iso639\Key::DEFAULT . "'");
            }
            $this->language[$key] = (new \Ruga\I18n\Iso639())->find($this->language[Iso639\Key::DEFAULT], $key);
        }
        return $this->language[$key];
    }
    
    
    
    /**
     * Set the locale.
     *
     * @param string $locale
     *
     * @todo not finished yet. always returns the string as given by setLocale().
     */
    public function setLocale(string $locale)
    {
//        $this->locale[Iso3166\Key::DEFAULT] = (new \Ruga\I18n\Iso3166())->find($locale, Iso3166\Key::DEFAULT);
        $this->locale[Iso3166\Key::DEFAULT] = $locale;
    }
    
    
    
    /**
     * Return the locale string as defined by $key.
     *
     * @param string|null $key A constant from Iso3166\Key
     *
     * @return string
     * @todo not finished yet. always returns the string as given by setLocale().
     */
    public function getLocale(string $key = null): string
    {
        /*
        if (!$key) {
            $key = Iso3166\Key::DEFAULT;
        }
        if (!($this->locale[$key] ?? null)) {
            $this->locale[$key] = (new \Ruga\I18n\Iso3166())->find($this->locale[Iso3166\Key::DEFAULT], $key);
        }
        return $this->locale[$key];
        */
        
        return $this->locale[Iso3166\Key::DEFAULT];
    }
    
    
}