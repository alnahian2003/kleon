<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case Pending = 'pending';
    case Open = 'open';
    case Completed = 'completed';
    case Cancelled = 'cancelled';
    case Delayed = 'delayed';

    // Open - 1,
    // On Progress - 2,
    // Completed - 3,
    // Cancelled - 4
    // Delayed - 5
}
