<?php

use Carbon\Carbon;

if (!function_exists('convert_date')) {
    function convert_date($date)
    {
        return Carbon::parse($date)->isoFormat('DD MMMM Y');
    }
}
