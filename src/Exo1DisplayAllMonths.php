<?php

class Exo1DisplayAllMonths
{
    const LOCALE_FR  = 'fr-FR';

    public function displayAllMonths()
    {
        $p = [];

        self::getLocale(self::LOCALE_FR);

        for($m = 1;$m <= 12; $m++){

            $p[] =  strftime("%B", mktime(0, 0, 0, $m, 1));
        }

        return $p;

    }

    private function getLocale($current_locale)
    {
        return  setlocale (LC_ALL, $current_locale);
    }

    public function __toString()
    {
       return  'test';
    }


}