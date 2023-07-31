<?php

namespace Nemorize\Indexnow;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException as GuzzleClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Nemorize\Indexnow\Exceptions\BadRequestException;
use Nemorize\Indexnow\Exceptions\ForbiddenException;
use Nemorize\Indexnow\Exceptions\IndexnowException;
use Nemorize\Indexnow\Exceptions\TooManyRequestsException;
use Nemorize\Indexnow\Exceptions\UnprocessableEntityException;

class Indexnow implements IndexnowInterface
{
    private string $host = 'api.indexnow.org';
    private string $key;
    private ?string $keyLocation = null;

    public function setHost (string $host): void
    {
        $this->host = $host;
    }

    public function getHost (): string
    {
        return $this->host;
    }

    public function setKey (string $key): void
    {
        $this->key = $key;
    }

    public function getKey (): string
    {
        return $this->key;
    }

    public function setKeyLocation (?string $keyLocation): void
    {
        $this->keyLocation = $keyLocation;
    }

    public function getKeyLocation (): ?string
    {
        return $this->keyLocation;
    }

    /**
     * @throws IndexnowException
     */
    public function submit (array|string $url, array $guzzleOptions = null): void
    {
        $baseUrl = 'https://' . $this->getHost() . '/indexnow';

        if (!is_array($url)) {
            $body = [ 'url' => $url, 'key' => $this->getKey() ];
            if ($this->getKeyLocation() !== null) {
                $body['keyLocation'] = $this->getKeyLocation();
            }
            $request = new Request('GET', $baseUrl . '?' . http_build_query($body));
        }
        else {
            $host = explode('/', explode('://', end($url), 2)[1], 2)[0];
            $body = [ 'urlList' => $url, 'host' => $host, 'key' => $this->getKey() ];
            if ($this->getKeyLocation() !== null) {
                $body['keyLocation'] = $this->getKeyLocation();
            }
            $request = new Request('POST', $baseUrl, [ 'Content-Type' => 'application/json' ], json_encode($body));
        }

        try {
            (new GuzzleClient())->send($request, $guzzleOptions ?? []);
        } catch (GuzzleException $e) {
            if (!$e instanceof GuzzleClientException) {
                throw new IndexnowException($e->getMessage(), $e->getCode(), $e);
            }
            switch ($e->getResponse()->getStatusCode()) {
                case 400:
                    throw new BadRequestException();
                case 403:
                    throw new ForbiddenException();
                case 422:
                    throw new UnprocessableEntityException();
                case 429:
                    throw new TooManyRequestsException();
            }
            throw $e;
        }
    }
}