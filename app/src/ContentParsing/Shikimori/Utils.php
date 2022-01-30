<?php

namespace App\ContentParsing\Shikimori;

class Utils
{

    public static function StrToDate(string $value): \DateTime
    {
        $parts = explode(' ', $value);
        if (count($parts) != 3) {
            throw new \Exception('Incorrent date format "' . $value . '"');
        }
        list($d, $mStr, $y) = $parts;
        $monthMap = [
            'янв.' => '1',
            'январь' => '1',
            'января' => '1',
            'февр.' => '2',
            'февраль' => '2',
            'февраля' => '2',
            'март' => '3',
            'марта' => '3',
            'апр.' => '4',
            'апрель' => '4',
            'апреля' => '4',
            'май' => '5',
            'мая' => '5',
            'июнь' => '6',
            'июня' => '6',
            'июль' => '7',
            'июля' => '7',
            'авг.' => '8',
            'август' => '8',
            'августа' => '8',
            'сент.' => '9',
            'сентябрь' => '9',
            'сентября' => '9',
            'окт.' => '10',
            'октябрь' => '10',
            'октября' => '10',
            'нояб.' => '11',
            'ноябрь' => '11',
            'ноябрья' => '11',
            'дек.' => '12',
            'декабрь' => '12',
            'декабря' => '12',
        ];
        if (is_numeric($mStr) && $mStr >= 1 && $mStr <= 12) {
            $m = (int)$mStr;
        } elseif (isset($monthMap[$mStr])) {
            $m = $monthMap[$mStr];
        } else {
            throw new \Exception('Undefined month "' . $mStr . '"');
        }
        $dateStr = implode('-', [$d, $m, $y]);
        $date = \DateTime::createFromFormat('d-m-Y', $dateStr);
        return $date;
    }

}