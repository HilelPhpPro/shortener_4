<?php

namespace Hillel\Shortener\ValueObjects;

class UrlCodePair
{
    /**
     * @param string $code
     * @param string $url
     */
    public function __construct(protected string $code, protected string $url)
    {
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }


}