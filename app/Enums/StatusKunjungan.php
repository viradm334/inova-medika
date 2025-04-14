<?php

namespace App\Enums;

enum StatusKunjungan: string
{
    case PENDING = 'pending';
    case ONGOING = 'ongoing';
    case FINISHED = 'finished';
}
