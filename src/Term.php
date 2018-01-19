<?php

declare(strict_types=1);

namespace Ymarillet\ValueEnum;

final class Term
{
    /**
     * @var mixed
     */
    private $key;

    /**
     * @var mixed
     */
    private $value;

    final public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    final public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    final public function getValue()
    {
        return $this->value;
    }
}
