<?php

namespace MohamedSabil83\LaravelHijrian;

use Carbon\Carbon;
use MohamedSabil83\LaravelHijrian\Concerns\InteractsWithDates;

class LaravelHijrian
{
    use InteractsWithDates;

    private static $date;

    public function __construct()
    {
        self::$date = new Carbon();
    }

    /**
     * Return Hijri date.
     *
     * @param  string|null  $date
     * @return \Carbon\Carbon
     */
    public static function hijri($date = null)
    {
        self::$date = new Carbon;

        [$year, $month, $day] = explode('-', self::$date->parse($date)->format('Y-m-d'));

        return self::gth((int) $year, (int) $month, (int) $day);
    }

    public static function hijriDateTime($date = null)
    {

        $time = date('H:i:s', strtotime($date));
        // $time =  str_replace('PM','م', $time);
        // $time =  str_replace('AM','ص',$time);
        $date = date('Y-m-d', strtotime($date));

        [$hours, $minutes, $seconds] = explode(':', $time);
        [$year, $month, $day] = explode('-', self::$date->parse($date)->format('Y-m-d'));

        return self::gth2((int) $year, (int) $month, (int) $day, (int) $hours, (int) $minutes, (int) $seconds);
    }

    /**
     * Return Gregorian date.
     *
     * @param  string|null  $date
     * @return \Carbon\Carbon
     */
    public static function gregory($date = null)
    {
        self::$date = new Carbon;

        if (empty($date)) {
            return self::$date->now();
        }

        [$year, $month, $day] = explode('-', self::$date->parse($date)->format('Y-m-d'));

        return self::htg((int) $year, (int) $month, (int) $day);
    }

    public static function gregoryDateTime($date = null)
    {
        if (empty($date)) {
            return self::$date->now();
        }

        // check Arabic Date And Replace AM & PM
        $date = str_replace('م', 'PM', $date);
        $date = str_replace('ص', 'AM', $date);

        $time = date('G:i:s', strtotime($date));
        $date = date('Y-m-d', strtotime($date));

        [$hours, $minutes, $seconds] = explode(':', $time);
        [$year, $month, $day] = explode('-', self::$date->parse($date)->format('Y-m-d'));

        return self::htg2((int) $year, (int) $month, (int) $day, (int) $hours, (int) $minutes, (int) $seconds);
    }
}
