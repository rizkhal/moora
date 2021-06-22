<?php

if (!function_exists('objectToArray')) {
    // convert multidimensional object to array
    function objectToArray ($object) {
        if(!is_object($object) && !is_array($object)){
            return $object;
        }
        return array_map('objectToArray', (array) $object);
    }
}