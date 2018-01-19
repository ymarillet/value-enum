<?php

use Ymarillet\ValueEnum\Set;
use Ymarillet\ValueEnum\Term;
use Ymarillet\ValueEnum\Traits\SetHolder;

class HttpHeaders
{
    use SetHolder;

    const AUTHORIZATION = 'Authorization';
    const ACCEPT = 'Accept';
    const CONTENT_TYPE = 'Content-Type';
    const CONTENT_DISPOSITION = 'Content-Disposition';
    const CACHE_TAGS = 'Cache-Tags';

    public function __construct()
    {
        $this->data = new Set([
            new Term(self::AUTHORIZATION, self::AUTHORIZATION),
            new Term(self::ACCEPT, self::ACCEPT),
            new Term(self::CONTENT_TYPE, self::CONTENT_TYPE),
        ]);
    }
}
