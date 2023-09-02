<?php
/*
 * SPDX-FileCopyrightText: 2023 Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 * SPDX-License-Identifier: AGPL-3.0-only
 */

declare(strict_types=1);

namespace Ruga\I18n;

use Ruga\I18n\Dataaccess\DataProvider;
use Ruga\I18n\Dataaccess\Exception\OutOfRangeException;

/**
 * Codes for the Representation of Names of Languages - ISO 639.
 * Loads the data and holds the filtered (if desired) list.
 *
 * @see      https://www.iso.org/iso-639-language-codes.html
 * @see      DataProvider
 * @author   Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 */
class Iso639 extends DataProvider
{
    /**
     * {@inheritDoc}
     * @see \Ruga\I18n\Dataaccess\DataProvider::getOriginalData()
     */
    protected function getOriginalData(): array
    {
        return include(__DIR__ . '/../data/Iso639data.php');
    }
    
    
    
    /**
     * Returns the field $desiredName from the record $id.
     *
     * @param mixed  $id
     * @param string $desiredName
     * @param null   $default
     *
     * @return string
     */
    public function find($id, $desiredName, $default = null): string
    {
        $id = strtolower($id);
        try {
            return $this->getString($id, $desiredName);
        } catch (OutOfRangeException $e) {
            try {
                return (new \Ruga\I18n\Iso639(
                    (new \Ruga\I18n\Iso639\Filter\All())
                        ->then(new \Ruga\I18n\Iso639\Filter\ChangeKey(\Ruga\I18n\Iso639\Key::ALPHA_2))
                ))->getString($id, $desiredName);
            } catch (OutOfRangeException $e) {
                try {
                    $id = strtoupper($id);
                    return (new \Ruga\I18n\Iso639(
                        (new \Ruga\I18n\Iso639\Filter\All())
                            ->then(new \Ruga\I18n\Iso639\Filter\ChangeKey(\Ruga\I18n\Iso639\Key::ONELETTER))
                    ))->getString($id, $desiredName);
                } catch (OutOfRangeException $e) {
                    if ($default === null) {
                        throw $e;
                    } else {
                        return $this->getString($default, $desiredName);
                    }
                }
            }
        }
    }
    
}
