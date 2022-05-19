<?php

declare(strict_types=1);

namespace Ruga\I18n\Iso3166\Filter;

use Ruga\I18n\Dataaccess\DataFilter;
use Ruga\I18n\Dataaccess\DataFilterInterface;


/**
 * Apply a custom filter to the data set.
 *
 * @see      \Ruga\I18n\Dataaccess\DataFilter
 * @see      \Ruga\I18n\Dataaccess\DataFilterInterface
 * @author   Roland Rusch, easy-smart solution GmbH <roland.rusch@easy-smart.ch>
 */
class Custom extends DataFilter implements DataFilterInterface
{
    /**
     * Array of wanted values.
     *
     * @var array
     */
    private $Custom_values = null;
    
    /**
     * Key to check for the values in $this->Custom_values.
     *
     * @var string
     */
    private $Custom_key = null;
    
    
    
    /**
     * Set values for filter.
     *
     * @param array $values
     * @param mixed $key
     */
    public function __construct(array $values, $key)
    {
        $this->Custom_values = $values;
        $this->Custom_key = $key;
    }
    
    
    
    /**
     * {@inheritDoc}
     * @see \Ruga\I18n\Dataaccess\DataFilterInterface::selectItem()
     */
    protected function selectItem(&$key, &$val): bool
    {
        $needle = $val[$this->Custom_key];
        return in_array($needle, $this->Custom_values);
    }
}
