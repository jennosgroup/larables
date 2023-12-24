<?php

namespace JennosGroup\Laratables;

class Url
{
    /**
     * The url to work with.
     */
    private string $url;

    /**
     * The url parts.
     */
    private array $parts = [];

    /**
     * Create an instance of the class.
     */
    public function __construct(string $url)
    {
        $this->url = $url;
        $this->parts = $this->getUrlParts($url);
    }

    /**
     * Get the url scheme.
     */
    public function scheme(): ?string
    {
        $scheme = $this->parts[1] ?? null;
        return empty($scheme) ? null : $scheme;
    }

    /**
     * Get the url domain.
     */
    public function domain(): ?string
    {
        $domain = $this->parts[2] ?? null;
        return empty($domain) ? null : $domain;
    }

    /**
     * Get the url port.
     */
    public function port(): ?int
    {
        $port = $this->parts[3] ?? null;

        if (empty($port)) {
            return null;
        }

        return str_replace(':', '', $port);
    }

    /**
     * Get the url path.
     */
    public function path(): ?string
    {
        $path = $this->parts[4] ?? null;
        return empty($path) ? null : $path;
    }

    /**
     * Get the url query string.
     */
    public function query(): ?string
    {
        $query = $this->parts[5] ?? null;
        return empty($query) ? null : $query;
    }

    /**
     * Get the url query string parameters.
     */
    public function queryArgs(array $except = []): array
    {
        $results = [];
        $queryString = $this->query();

        if (empty($queryString)) {
            return [];
        }

        $parameters = explode('&', $queryString);

        foreach ($parameters as $parameter) {
            $parts = explode('=', $parameter);

            if (count($parts) == 2 && ! in_array($parts[0], $except)) {
                $results[$parts[0]] = $parts[1];
            }
        }

        return $results;
    }

    /**
     * Get the url hash.
     */
    public function hash(): ?string
    {
        $hash = $this->parts[6] ?? null;
        return empty($hash) ? null : $hash;
    }

    /**
     * Check if the current request has query parameters.
     */
    public function hasQueryParameters(): bool
    {
        return ! empty($this->query());
    }

    /**
     * Get the url parts.
     */
    public function getUrlParts(string $url): array
    {
        preg_match('/^(https|http|ftp|mailto|file){0,1}:{0,1}\/{0,2}((?:[a-z0-9-]*\.{1}[a-z0-9]+)*)(:[0-9]+)*\/*([^\?|#]*)\?*([^\#]*)\#*(.*)$/', urldecode($url), $matches);
        return $matches;
    }
}
