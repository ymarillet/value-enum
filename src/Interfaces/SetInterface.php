<?php

declare(strict_types=1);

namespace Ymarillet\ValueEnum\Interfaces;

use Ymarillet\ValueEnum\Exception\TermNotFoundException;
use Ymarillet\ValueEnum\Term;

interface SetInterface
{
    /**
     * @return Term[]
     */
    public function getAll(): array;

    /**
     * @param mixed $key
     *
     * @return Term
     * @throws TermNotFoundException
     */
    public function findByKey($key): Term;

    /**
     * @param mixed $value
     *
     * @return Term
     * @throws TermNotFoundException
     */
    public function findByValue($value): Term;

    /**
     * @param mixed $key
     *
     * @return bool
     */
    public function hasKey($key): bool;

    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function hasValue($value): bool;

    /**
     * @param mixed $key
     *
     * @return void
     * @throws TermNotFoundException
     */
    public function requireKey($key);

    /**
     * @param mixed $value
     *
     * @return void
     * @throws TermNotFoundException
     */
    public function requireValue($value);

    /**
     * @return array
     */
    public function toArray(): array;
}
