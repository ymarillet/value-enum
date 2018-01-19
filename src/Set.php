<?php

declare(strict_types=1);

namespace Ymarillet\ValueEnum;

use Ymarillet\ValueEnum\Exception\TermNotFoundException;
use Ymarillet\ValueEnum\Interfaces\SetInterface;

final class Set implements SetInterface
{
    /**
     * @var Term[]
     */
    private $collection = [];

    /** @var bool */
    private $hasScalarKeys = true;

    /** @var array|null */
    private $toArrayCache = null;

    /**
     * @param Term[] $terms
     */
    public function __construct(array $terms)
    {
        foreach ($terms as $term) {
            if (!$term instanceof Term) {
                throw new \LogicException('You must provide only instances of Term');
            }

            if ($this->hasScalarKeys && !is_scalar($term->getKey())) {
                $this->hasScalarKeys = false;
            }
        }

        $this->collection = $terms;
    }

    /**
     * @return Term[]
     */
    public function getAll(): array
    {
        return $this->collection;
    }

    /**
     * @param mixed $search
     * @param callback $callback
     *
     * @return Term
     * @throws TermNotFoundException
     */
    private function findBy($search, callable $callback): Term
    {
        $return = null;
        foreach ($this->collection as $term) {
            if (call_user_func($callback, $term) === $search) {
                $return = $term;
                break;
            }
        }

        if (null === $return) {
            $this->unknownTermException($search);
        }

        return $return;
    }

    /**
     * @param mixed $search
     *
     * @throws TermNotFoundException
     */
    private function unknownTermException($search)
    {
        try {
            $strRepresentation = strval($search);
        } catch (\Throwable $error) {
            $strRepresentation = serialize($search);
        }

        throw new TermNotFoundException(sprintf('The Term "%s" could not be found', $strRepresentation));
    }

    /**
     * @param mixed $key
     *
     * @return Term
     * @throws TermNotFoundException
     */
    public function findByKey($key): Term
    {
        return $this->findBy($key, [$this, 'getTermKey']);
    }

    /**
     * @param Term $term
     *
     * @return mixed
     */
    private function getTermKey(Term $term)
    {
        return $term->getKey();
    }

    /**
     * @param mixed $value
     *
     * @return Term
     * @throws TermNotFoundException
     */
    public function findByValue($value): Term
    {
        return $this->findBy($value, [$this, 'getTermValue']);
    }

    /**
     * @param Term $term
     *
     * @return mixed
     */
    private function getTermValue(Term $term)
    {
        return $term->getValue();
    }

    /**
     * @param mixed $search
     * @param callback $callback
     * @param bool $require
     *
     * @return bool
     * @throws TermNotFoundException
     */
    private function has($search, callable $callback, bool $require): bool
    {
        try {
            return (call_user_func($callback, $search) instanceof Term);
        } catch (TermNotFoundException $e) {
            if ($require) {
                throw $e;
            }

            return false;
        }
    }

    /**
     * @param mixed $key
     *
     * @return bool
     * @throws
     */
    public function hasKey($key): bool
    {
        if ($this->hasScalarKeys) {
            return is_scalar($key) ? array_key_exists($key, $this->toArray()) : false;
        }

        return $this->has($key, [$this, 'findByKey'], false);
    }

    /**
     * @param mixed $value
     *
     * @return bool
     * @throws
     */
    public function hasValue($value): bool
    {
        return $this->has($value, [$this, 'findByValue'], false);
    }

    /**
     * @param mixed $key
     *
     * @return void
     * @throws TermNotFoundException
     */
    public function requireKey($key)
    {
        $this->has($key, [$this, 'findByKey'], true);
    }

    /**
     * @param mixed $value
     *
     * @return void
     * @throws TermNotFoundException
     */
    public function requireValue($value)
    {
        $this->has($value, [$this, 'findByValue'], true);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        if (null !== $this->toArrayCache) {
            return $this->toArrayCache;
        }

        if (!$this->hasScalarKeys) {
            throw new \LogicException('The keys must be scalar to use toArray().');
        }

        $this->toArrayCache = [];

        foreach ($this->collection as $term) {
            $this->toArrayCache[$term->getKey()] = $term->getValue();
        }

        return $this->toArrayCache;
    }
}
