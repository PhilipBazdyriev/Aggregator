<?php

namespace App\Tools;

class Str
{

    public static function slugify($string) {
        $alphabet = array (
            // upper case
            'А' => 'A',     'Б' => 'B',     'В' => 'V',     'Г' => 'H',
            'ЗГ' => 'Zgh',  'Зг' => 'Zgh',  'Ґ' => 'G',     'Д' => 'D',
            'Е' => 'E',     'Є' => 'IE',    'Ж' => 'Zh',    'З' => 'Z',
            'И' => 'Y',     'І' => 'I',     'Ї' => 'I',     'Й' => 'I',
            'К' => 'K',     'Л' => 'L',     'М' => 'M',     'Н' => 'N',
            'О' => 'O',     'П' => 'P',     'Р' => 'R',     'С' => 'S',
            'Т' => 'T',     'У' => 'U',     'Ф' => 'F',     'Х' => 'Kh',
            'Ц' => 'Ts',    'Ч' => 'Ch',    'Ш' => 'Sh',    'Щ' => 'Shch',
            'Ь' => '',      'Ю' => 'Iu',    'Я' => 'Ia',    '’' => '',
            // lower case
            'а' => 'a',     'б' => 'b',     'в' => 'v',     'г' => 'h',
            'зг' => 'zgh',  'ґ' => 'g',     'д' => 'd',     'е' => 'e',
            'є' => 'ie',    'ж' => 'zh',    'з' => 'z',     'и' => 'y',
            'і' => 'i',     'ї' => 'i',     'й' => 'i',     'к' => 'k',
            'л' => 'l',     'м' => 'm',     'н' => 'n',     'о' => 'o',
            'п' => 'p',     'р' => 'r',     'с' => 's',     'т' => 't',
            'у' => 'u',     'ф' => 'f',     'х' => 'kh',    'ц' => 'ts',
            'ч' => 'ch',    'ш' => 'sh',    'щ' => 'shch',  'ь' => '',
            'ю' => 'iu',    'я' => 'ia',    '\'' => '',

            // upper case
            'А' => 'A',     'Б' => 'B',     'В' => 'V',     'Г' => 'G',
            'Д' => 'D',     'Е' => 'E',     'Ё' => 'E',     'Ж' => 'Zh',
            'З' => 'Z',     'И' => 'I',     'Й' => 'I',     'К' => 'K',
            'Л' => 'L',     'М' => 'M',     'Н' => 'N',     'О' => 'O',
            'П' => 'P',     'Р' => 'R',     'С' => 'S',     'Т' => 'T',
            'У' => 'U',     'Ф' => 'F',     'Х' => 'Kh',    'Ц' => 'Ts',
            'Ч' => 'Ch',    'Ш' => 'Sh',    'Щ' => 'Shch',  'Ъ' => 'Ie',
            'Ы' => 'Y',     'Ь' => '',      'Э' => 'E',     'Ю' => 'Iu',
            'Я' => 'Ia',
            // lower case
            'а' => 'a',     'б' => 'b',     'в' => 'v',     'г' => 'g',
            'д' => 'd',     'е' => 'e',     'ё' => 'e',     'ж' => 'zh',
            'з' => 'z',     'и' => 'i',     'й' => 'i',     'к' => 'k',
            'л' => 'l',     'м' => 'm',     'н' => 'n',     'о' => 'o',
            'п' => 'p',     'р' => 'r',     'с' => 's',     'т' => 't',
            'у' => 'u',     'ф' => 'f',     'х' => 'kh',    'ц' => 'ts',
            'ч' => 'ch',    'ш' => 'sh',    'щ' => 'shch',  'ъ' => 'ie',
            'ы' => 'y',     'ь' => '',      'э' => 'e',     'ю' => 'iu',
            'я' => 'ia',
        );
        $string = str_replace(
            array_keys($alphabet),
            array_values($alphabet),
            preg_replace(
            // use alternative variant at the beginning of a word
                array (
                    '/(?<=^|\s)Є/', '/(?<=^|\s)Ї/', '/(?<=^|\s)Й/',
                    '/(?<=^|\s)Ю/', '/(?<=^|\s)Я/', '/(?<=^|\s)є/',
                    '/(?<=^|\s)ї/', '/(?<=^|\s)й/', '/(?<=^|\s)ю/',
                    '/(?<=^|\s)я/',
                ),
                array (
                    'Ye', 'Yi', 'Y', 'Yu', 'Ya', 'ye', 'yi', 'y', 'yu', 'ya',
                ),
                $string)
        );

        $string = trim($string);
        $string = str_replace(' ', '-', $string);
        $string = preg_replace("/[^a-zA-Z0-9\-\+]/", '', $string);
        $string = strtolower($string);
        return $string;
    }

}
