<?php
/*
 * SPDX-FileCopyrightText: 2023 Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 * SPDX-License-Identifier: AGPL-3.0-only
 */

declare(strict_types=1);

namespace Ruga\I18n\Iso3166\Filter;

use Ruga\I18n\Dataaccess\DataFilterInterface;
use Ruga\I18n\Iso3166\Key;


/**
 * Applies a filter to only select central european countries.
 *
 * @see      Custom
 * @see      \Ruga\I18n\Dataaccess\DataFilter
 * @see      \Ruga\I18n\Dataaccess\DataFilterInterface
 * @author   Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 */
class CentralEurope extends Custom implements DataFilterInterface
{
    /**
     * Countries in Europe.
     *
     * @var array
     */
    const CentralEurope_Countries = ['CHE', 'DEU', 'AUT', 'ITA', 'FRA', 'ESP', 'PRT', 'GBR'];
    
    
    
    /**
     * Set predefined values.
     */
    public function __construct()
    {
        parent::__construct(static::CentralEurope_Countries, Key::ALPHA_3);
    }
}
