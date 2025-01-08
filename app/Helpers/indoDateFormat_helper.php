<?php

if (!function_exists('indoDateFormat')) {
    
    /**
     * Convert a date to Indonesian date format.
     *
     * @param string $date The input date (e.g., '2024-11-24')
     * @return string The formatted date (e.g., 'Sen, 14 Nov 2024')
     *
     */

    function indoDateFormat($date)
    {
        $day = [
            'Sun' => 'Min',
            'Mon' => 'Sen',
            'Tue' => 'Sel',
            'Wed' => 'Rab',
            'Thu' => 'Kam',
            'Fri' => 'Jum',
            'Sat' => 'Sab',
        ];

        $month = [
            'Jan' => 'Jan',
            'Feb' => 'Feb',
            'Mar' => 'Mar',
            'Apr' => 'Apr',
            'May' => 'Mei',
            'Jun' => 'Jun',
            'Jul' => 'Jul',
            'Aug' => 'Agu',
            'Sep' => 'Sep',
            'Oct' => 'Okt',
            'Nov' => 'Nov',
            'Dec' => 'Des',
        ];

        $dateObj = new DateTime($date);
        $dayNameFormatted  = $day[$dateObj->format('D')];
        $monthNameFormatted  = $month[$dateObj->format('M')];

        return "{$dayNameFormatted}, {$dateObj->format('j')} {$monthNameFormatted} {$dateObj->format('Y')}";
    }
}
