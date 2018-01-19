<?php

declare(strict_types=1);

namespace Ymarillet\ValueEnum\Traits;

use Ymarillet\ValueEnum\Exception\TermNotFoundException;
use Ymarillet\ValueEnum\Set;
use Ymarillet\ValueEnum\Term;

trait SetHolder
{
    /**
     * @var Set
     */
    private $data;

    /**
     * @return Term[]
     */
    public function getAll(): array
    {
        return $this->data->getAll();
    }

    /**
     * @param mixed $search
     *
     * @return Term
     * @throws TermNotFoundException
     */
    public function findByKey($search): Term
    {
        return $this->data->findByKey($search);
    }

    /**
     * @param mixed $search
     *
     * @return Term
     * @throws TermNotFoundException
     */
    public function findByValue($search): Term
    {
        return $this->data->findByValue($search);
    }

    /**
     * @param mixed $search
     * @return bool
     */
    public function hasKey($search): bool
    {
        return $this->data->hasKey($search);
    }

    /**
     * @param mixed $search
     * @return bool
     */
    public function hasValue($search): bool
    {
        return $this->data->hasValue($search);
    }

    /**
     * @param mixed $search
     * @throws TermNotFoundException
     * @return void
     */
    public function requireKey($search)
    {
        $this->data->requireKey($search);
    }

    /**
     * @param mixed $search
     * @throws TermNotFoundException
     * @return void
     */
    public function requireValue($search)
    {
        $this->data->requireValue($search);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->data->toArray();
    }
}
