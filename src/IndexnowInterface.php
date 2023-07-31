<?php

namespace Nemorize\Indexnow;

interface IndexnowInterface
{
    /**
     * Get the search engine name.
     *
     * @param string $host
     * @return void
     */
    public function setHost (string $host): void;

    /**
     * Get the search engine hostname.
     *
     * @return string
     */
    public function getHost (): string;

    /**
     * Get the search engine API key.
     *
     * @param string $key
     * @return void
     */
    public function setKey (string $key): void;

    /**
     * Get the search engine API key.
     *
     * @return string
     */
    public function getKey (): string;

    /**
     * Set the keyLocation URL. Set to null to use the root directory.
     *
     * @param string|null $keyLocation
     * @return void
     */
    public function setKeyLocation (?string $keyLocation): void;

    /**
     * Get the keyLocation URL.
     *
     * @return string|null
     */
    public function getKeyLocation (): ?string;

    /**
     * Submit URL(s) to the search engine.
     *
     * @param string|array $url
     * @return void
     */
    public function submit (string|array $url): void;
}