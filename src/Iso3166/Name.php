<?php
/*
 * SPDX-FileCopyrightText: 2023 Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 * SPDX-License-Identifier: AGPL-3.0-only
 */

declare(strict_types=1);

namespace Ruga\I18n\Iso3166;

/**
 * Names for the iso3166 list.
 *
 * @see      \Ruga\I18n\Iso3166
 * @author   Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 */
abstract class Name/* extends Ruga_Enum */
{
    /** Englisch */
    const ENG = 'NAME_eng';
    /** Französisch */
    const FRA = 'NAME_fra';
    /** Deutsch */
    const DEU = 'NAME_deu';
    
    
    protected static $fullnameMap = [
        self::ENG => 'Englische Bezeichnung',
        self::FRA => 'Französische Bezeichnung',
        self::DEU => 'Deutsche Bezeichnung',
    ];
}
