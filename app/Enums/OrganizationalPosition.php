<?php

namespace App\Enums;

enum OrganizationalPosition: string
{
    case Officer = 'Officer';
    case Dancer = 'Dancer';
    case Singer = 'Singer';
    case Actor = 'Actor';
    case Actress = 'Actress';
    case Artist = 'Artist';
    case Instrumentalist = 'Instrumentalist';
    case Others = 'Others';
}
