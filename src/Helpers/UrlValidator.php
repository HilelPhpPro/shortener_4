<?php

namespace Hillel\Shortener\Helpers;

use Hillel\Shortener\Interfaces\IUrlValidator;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use InvalidArgumentException;

class UrlValidator implements IUrlValidator
{
    /**
     * @param ClientInterface $client
     */
    public function __construct(protected ClientInterface $client)
    {
    }


    /**
     * @inheritDoc
     */
    public function validateUrl(string $url): true
    {
        if (empty($url)
            || !filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('Url is broken');
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function checkRealUrl(string $url): true
    {
        $allowCodes = [
            200, 201, 301, 302
        ];
        try {
            $response = $this->client->get($url);
            return (!empty($response->getStatusCode()) && in_array($response->getStatusCode(), $allowCodes));
        } catch (ConnectException $exception) {
            throw new InvalidArgumentException($exception->getMessage(), $exception->getCode());
        }

    }
}