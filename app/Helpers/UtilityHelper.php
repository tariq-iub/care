<?php

if (!function_exists('getAverageType')) {
    function getAverageType()
    {
        return ['Spectral', 'Time synchronous'];
    }
}

if (!function_exists('getAverageOverlapPercentages')) {

    function getAverageOverlapPercentages()
    {
        return ['0%', '12.5%', '25%', '37.5%', '50%', '62.5%', '75%'];
    }
}
if (!function_exists('getWindowType')) {
    function getWindowType()
    {
        return ['Hanning', 'Hamming', 'Rectangular', 'Flat top'];
    }
}

if (!function_exists('getHighPassFilters')) {
    function getHighPassFilters()
    {
        return ['500Hz', '1000Hz', '2000Hz', '3000Hz', '4000Hz', '5000Hz'];
    }
}

if (!function_exists('getBandPassFilters')) {
    function getBandPassFilters()
    {
        return  ['1250-2500Hz', '1250-5000Hz', '1250-10000Hz', '2500-5000Hz', '3400-4400Hz', '5000-10000Hz'];
    }
}
