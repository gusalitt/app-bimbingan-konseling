<?php

if (!function_exists('getActiveSidebarItem')) {

    /**
     * Check if the current URL matches any of the given paths and return the 'active' class.
     *
     * @param array $paths Array of paths to check against the current URL
     * @return string 'active' if a match is found, otherwise an empty string
     *
     */

    function getActiveSidebarItem(array $paths)
    {

        $currentUrl = $_SERVER['REQUEST_URI'];

        foreach ($paths as $path) {
            if (strpos($currentUrl, $path) !== false) {
                return 'active';
            }
        }
        return '';
    }
}
