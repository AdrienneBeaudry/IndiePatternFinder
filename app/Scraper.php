<?php

namespace App;

class Scraper
{
    public static function readLanguage($string) {
        $language = "";
        if (strpos($string, 'english') !== false) {
            $language = $language . "English ";
        }
        if (strpos($string, 'finnish') !== false) {
            $language = $language . "Finnish ";
        }
        if (strpos($string, 'french') !== false) {
            $language = $language . "French ";
        }
        if (strpos($string, 'german') !== false) {
            $language = $language . "German ";
        }
        if (strpos($string, 'japanese') !== false) {
            $language = $language . "Japanese ";
        }
        if (strpos($string, 'spanish') !== false) {
            $language = $language . "Spanish ";
        }
        return $language;
    }

    public static function readFormat($string) {
        $format = null;
        if (strpos($string, 'pdf') !== false && strpos($string, 'print') !== false) {
            $format = 3;
        } elseif (strpos($string, 'pdf') !== false) {
            $format = 1;
        } elseif (strpos($string, 'print') !== false) {
            $format = 2;
        }
        return $format;
    }

    public static function readCategory($string){
        /*
           $category = null;
           if (strpos($raw_category, 'dress') !== false) {
               $category = 3;
           } elseif (strpos($string, 'pdf') !== false) {
               $category = 1;
           } elseif (strpos($string, 'print') !== false) {
               $category = 2;
           }
           */

        /* Border cases:
         * - dress shirt
         * - bath robe - men's / bath robe women's
         * - other languages?
         *
         *
         * */
    }

    public static function lastWord($string)
    {
        $pieces = explode(' ', $string);
        $last_word = array_pop($pieces);
        return $last_word;
    }
}
