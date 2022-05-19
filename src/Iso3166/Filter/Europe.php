<?php

declare(strict_types=1);

namespace Ruga\I18n\Iso3166\Filter;

use Ruga\I18n\Dataaccess\DataFilterInterface;
use Ruga\I18n\Iso3166\Key;


/**
 * Applies a filter to only select european countries.
 *
 * @see      Custom
 * @see      \Ruga\I18n\Dataaccess\DataFilter
 * @see      \Ruga\I18n\Dataaccess\DataFilterInterface
 * @author   Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 */
class Europe extends Custom implements DataFilterInterface
{
    /**
     * Set predefined values.
     */
    public function __construct()
    {
        parent::__construct(['150'], Key::REGION_CODE);
    }
}
