<?php

if (!function_exists('is_selected')) {

    /**
     * Check if the given currentValue is selected.
     *
     * @param mixed $value The value of the option
     * @param mixed $currentValue The current selected value
     * @return string Retruns 'selected' if the curentValue is selected, otherwise an empty string
     */
    
    function is_selected($value, $currentValue, $total = null)
    {
        if ($value == $currentValue) {
            return 'selected';
        }

        if ($total) {
            if ($value >= $total && $currentValue == $total) {
                return 'selected';
            }
        }

        return  '';
    }
}
