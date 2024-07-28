<?php

if ( !function_exists('dd') ) {
    function dd($variable)
    {
        var_dump($variable);
        die();
    }
}

if ( !function_exists('redirectTo') ) {
    function redirectTo(string $url): void
    {
        header('Location: '.$url);
        exit();
    }
}


if ( !function_exists('convertDateTime') ) {
    /**
     * @throws Exception
     */
    function convertDateTime($date, $time): string
    {
        $dateTime    = $date.' '.$time;
        $dateTimeObj = new DateTime($dateTime);

        $serverTimeZone = date_default_timezone_get();
        $timezone       = new DateTimeZone($serverTimeZone);

        $dateTimeObj->setTimezone($timezone);

        return $dateTimeObj->format('Y-m-d\TH:i:sP');
    }
}
