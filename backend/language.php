<?php

$translations = [
    'name' => [
        'AZ' => 'Ad',
        'TR' => 'Ad',
        'RU' => 'Imya',
        'EN' => 'Name',
    ],
];

function tr($text)
{
    global $translations, $lang;
    return $translations[$text][$lang];
}

?>