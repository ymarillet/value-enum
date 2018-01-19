<?php

declare(strict_types=1);

use Ymarillet\ValueEnum\Interfaces\SetInterface;
use Ymarillet\ValueEnum\Set;
use Ymarillet\ValueEnum\Term;
use Ymarillet\ValueEnum\Traits\SetHolder;

final class HttpHeaders implements SetInterface
{
    use SetHolder;

    const ACCEPT = 'Accept';
    const AUTHORIZATION = 'Authorization';
    const CACHE_TAGS = 'Cache-Tags';
    const CONTENT_DISPOSITION = 'Content-Disposition';
    const CONTENT_TYPE = 'Content-Type';

    public function __construct()
    {
        $this->data = new Set([
            new Term(self::ACCEPT, self::ACCEPT),
            new Term(self::AUTHORIZATION, self::AUTHORIZATION),
            new Term(self::CACHE_TAGS, self::CACHE_TAGS),
            new Term(self::CONTENT_DISPOSITION, self::CONTENT_DISPOSITION),
            new Term(self::CONTENT_TYPE, self::CONTENT_TYPE),
        ]);
    }
}
