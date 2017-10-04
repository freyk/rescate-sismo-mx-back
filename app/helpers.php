<?php

function getSubdomain()
{
    $host  = Request::getHost();
    $hostParts = explode('.', $host);
    $hostCollection = new Illuminate\Support\Collection($hostParts);

    return $hostCollection->first();
}

function formatDate($date, $format = 'Y-m-d')
{
    if (is_null($date)) {
        return null;
    }

    $timezone = Config::get('app.timezone');

    $d = new DateTime($date, new DateTimeZone($timezone));

    return $d->format($format);
}

function formatDateToISO8601($date)
{
    return formatDate($date, 'Y-m-d\TH:i:sP');
}

function formatDateToUnix($time)
{
    // We'll remove certain characters for backward compatibility
    // since the formatting changed with MySQL 4.1
    // YYYY-MM-DD HH:MM:SS

    $time = str_replace('-', '', $time);
    $time = str_replace(':', '', $time);
    $time = str_replace(' ', '', $time);

    // YYYYMMDDHHMMSS
    return mktime(
        substr($time, 8, 2),
        substr($time, 10, 2),
        substr($time, 12, 2),
        substr($time, 4, 2),
        substr($time, 6, 2),
        substr($time, 0, 4)
    );
}

function sanitize_data(array $data = [], array $allowed = [])
{
    foreach($data as $k => $v) {
        if (in_array($k, $allowed) == false) {
            unset($data[$k]);
        }
    }

    return $data;
}