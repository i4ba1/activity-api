<?php

namespace App\Util;

use DateTimeImmutable;
use DateTimeZone;

class DateUtil
{
    public static function dateTimeWithTimeZone(): DateTimeImmutable{
        $date = null;
        try {
            $date = new DateTimeImmutable();
            $date->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            echo $e->getTraceAsString();
        }
        return $date;
    }
}