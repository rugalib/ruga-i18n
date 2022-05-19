<?php

declare(strict_types=1);

namespace Ruga\I18n\Iso639\Filter;

use Ruga\I18n\Dataaccess\DataFilterInterface;
use Ruga\I18n\Dataaccess\DataFilter;


/**
 * This filter can be used to change the main key
 * of the data set.
 *
 * @see      \Ruga\I18n\Dataaccess\DataFilter
 * @see      \Ruga\I18n\Dataaccess\DataFilterInterface
 * @author   Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 */
class ChangeKey extends DataFilter implements DataFilterInterface
{
    /**
     * New key to use for the data set.
     *
     * @var string
     */
    private $ChangeKey_key = null;
    
    
    
    /**
     * Initialize filter and set the new key.
     *
     * @param mixed $key
     */
    public function __construct($key)
    {
        $this->ChangeKey_key = $key;
    }
    
    
    
    /**
     * {@inheritDoc}
     * @see \Ruga\I18n\Dataaccess\DataFilterInterface::selectItem()
     */
    protected function selectItem(&$key, &$val): bool
    {
        $key = $val[$this->ChangeKey_key] ?? null;
        return true;
    }
}
