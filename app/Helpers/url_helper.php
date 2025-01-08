<?php

use CodeIgniter\HTTP\IncomingRequest;

if (!function_exists('build_query_url')) {

    /**
     * Build a query URL with keyword, sort, order, and page parameters.
     *
     * @param string $base_url Base URL for the page
     * @param IncomingRequest $request Current request instance
     * @param string|null $identifier (Optional) Identifier to append to the URL
     * @param array $exclude Removes excluded query parameters
     * @return string Constructed URL with query parameters
     */

    function build_query_url(string $base_url, IncomingRequest $request, ?string $identifier = null, array $exclude = []): string
    {
        // Initialize base URL with optional identifier.
        $url = rtrim($base_url, '/') . ($identifier ? '/' . esc($identifier) : '');

        // Retrieve all query parameters from the request.
        $queryParams = $request->getGet();

        // Remove unwanted parameters.
        foreach ($exclude as $param) {
            unset($queryParams[$param]);
        }

        // Prepare query string.
        $queryString = http_build_query(array_filter($queryParams));

        // Append query string if exists.
        return $queryString ? $url . '?' . $queryString : $url;
    }
}
