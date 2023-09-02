<?php
/*
 * SPDX-FileCopyrightText: 2023 Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 * SPDX-License-Identifier: AGPL-3.0-only
 */

declare(strict_types=1);

namespace Ruga\I18n\Helper;

use Laminas\View\Helper\AbstractHelper;
use Ruga\I18n\LocalizationInterface;

/**
 * Class LocalizationViewHelper
 *
 * @author Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 */
class LocalizationViewHelper extends AbstractHelper
{
    private ?LocalizationInterface $localization = null;
    
    
    
    /**
     * @param LocalizationInterface|null $localization
     */
    public function setLocalization(?LocalizationInterface $localization): void
    {
        $this->localization = $localization;
    }
    
    
    
    /**
     * Return the language string in the given format.
     *
     * @param string|null $key Key from Iso639\Key
     *
     * @return string
     */
    public function getLanguage(string $key = null): string
    {
        return $this->localization->getLanguage($key);
    }
    
    
    
    /**
     * Return self to give access to all the methods of the helper.
     *
     * @return $this
     */
    public function __invoke(): self
    {
        return $this;
    }
    
    
}