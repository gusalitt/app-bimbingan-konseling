<?php

if (!function_exists('convertToBaliTime')) {

    /**
     * Convert a UTC datetime to Bali time (Asia/Makassar timezone).
     *
     * @param string $utcDateTime The UTC datetime string (e.g., '2024-11-17 08:41:28')
     * 
     * @return string The formatted date and time in Bali timezone (e.g., '28:41:16 17-11-2024')
     */

    function convertToBaliTime($utcDateTime)
    {
        $baliTimeZone = new DateTimeZone('Asia/Makassar');
        $dateTime = new DateTime($utcDateTime, new DateTimeZone('UTC'));

        $dateTime->setTimezone($baliTimeZone);
        return $dateTime->format('s:i:H d-m-Y');
    }
}
