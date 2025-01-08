<?php

if (!function_exists('generatedPagePaginationUrl')) {

    /**
     * Build a query URL for the pagination links.
     *
     * @param string $basePath Base URL for the page
     * @param array $queryParams Current query parameters from the request
     * @param string $pageParam The name of the pagination parameter
     * @return string URL with query parameters for pagination
     */

    function generatedPagePaginationUrl(string $basePath, array $queryParams,  string $pageParam): string
    {
        // Remove the pagination parameters from remaining parameters
        unset($queryParams[$pageParam]);

        // Build the query string from remaining parameters
        $queryString = http_build_query($queryParams);

        // Construct the final URL
        return site_url($basePath) . '?' . ($queryString ? $queryString . '&' : '') . $pageParam . '=';
    }
}
