<?php
/*
 * SPDX-FileCopyrightText: 2023 Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 * SPDX-License-Identifier: AGPL-3.0-only
 */

declare(strict_types=1);

namespace Ruga\I18n\Dataaccess;

/**
 * Provides countable functions to the data provider.
 *
 * @see      \Countable
 * @see      DataProvider
 * @see      DataProviderInterface
 * @author   Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 */
trait CountableTrait
{
    /**
     * Counts the number of records in the private $data array.
     *
     * @return int Number of records
     */
    public function count(): int
    {
        return count($this->DataProvider_DATA);
    }
}
