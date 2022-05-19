<?php

declare(strict_types=1);

namespace Ruga\I18n;

/**
 * Interface LocalizationInterface
 *
 * @package Ruga\I18n
 * @author   Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 */
interface LocalizationInterface
{
    const LOCALE_DEFAULT = 'locale_default';
    const LOCALE_ATTRIBUTE_NAME = 'locale_attr_name';
    const LANGUAGE_DEFAULT = 'language_default';
    const LANGUAGE_ATTRIBUTE_NAME = 'language_attr_name';
    const LANGUAGES = 'languages';
    const GETTEXT_POT = 'gettext_pot';
    const GETTEXT_SRC_DIRS = 'gettext_src';
    const GETTEXT_PO_DIR = 'gettest_po_dir';
    const GETTEXT_MO_DIR = 'gettest_mo_dir';
    const GETTEXT_SRC_LANG = 'gettext_src_lang';
    
    
    
    /**
     * Set the language.
     *
     * @param string $language
     */
    public function setLanguage(string $language);
    
    
    
    /**
     * Return the language string as defined by $key.
     *
     * @param string|null $key A constant from Iso639\Key
     *
     * @return string
     */
    public function getLanguage(string $key = null): string;
    
    
    
    /**
     * Set the locale.
     *
     * @param string $locale
     */
    public function setLocale(string $locale);
    
    
    
    /**
     * Return the locale string as defined by $key.
     *
     * @param string|null $key A constant from Iso3166\Key
     *
     * @return string
     * @todo not finished yet. always returns the string as given by setLocale().
     */
    public function getLocale(string $key = null): string;
}