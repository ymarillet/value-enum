<?php

declare(strict_types=1);

use Ymarillet\ValueEnum\Interfaces\SetInterface;
use Ymarillet\ValueEnum\Set;
use Ymarillet\ValueEnum\Term;
use Ymarillet\ValueEnum\Traits\SetHolder;

final class ContentTypes implements SetInterface
{
    use SetHolder;

    const JSONLD = 'jsonld';
    const HTML = 'html';
    const XML = 'xml';
    const JSON = 'json';

    const HTTP_JSONLD = 'application/ld+json';
    const HTTP_HTML = 'text/html';
    const HTTP_XML = 'text/xml';
    const HTTP_JSON = 'application/json';

    /**
     * @var Set
     */
    private $jsonFormats;

    public function __construct()
    {
        $this->data = new Set([
            $jsonld = new Term(self::JSONLD, self::HTTP_JSONLD),
            new Term(self::HTML, self::HTTP_HTML),
            new Term(self::XML, self::HTTP_XML),
            $json = new Term(self::JSON, self::HTTP_JSON),
        ]);

        $this->jsonFormats = new Set([
            $jsonld,
            $json,
        ]);
    }

    /**
     * @return Set
     */
    public function getJsonFormats(): Set
    {
        return $this->jsonFormats;
    }
}
