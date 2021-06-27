<?php

use Carbon\Carbon;

if (!function_exists('transpose')) {
    /**
     * Format array
     *
     * @param array $arr
     * @return array
     * @see https://stackoverflow.com/questions/2221476/flip-transpose-the-rows-and-columns-of-a-2d-array-without-changing-the-number
     */
    function transpose($arr)
    {
        $out = [];
        foreach ($arr as $key => $subarr) {
            foreach ($subarr as $subkey => $subvalue) {
                $out[$subkey][$key] = $subvalue;
            }
        }
        return $out;
    }
}

if (!function_exists('format_date')) {
    /**
     * Convert readable date
     *
     * @param  string $date
     * @return string
     */
    function format_date($date, $format = 'd F Y'): string
    {
        Carbon::setLocale('id_ID');
        return Carbon::parse($date)->translatedFormat($format);
    }
}

if (!function_exists('object_to_array')) {
    // convert multidimensional object to array
    function object_to_array($object)
    {
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }
        return array_map('object_to_array', (array) $object);
    }
}
