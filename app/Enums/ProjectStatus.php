<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case Pending = 'pending';
    case Open = 'open';
    case Completed = 'completed';
    case Cancelled = 'cancelled';
    case Delayed = 'delayed';
}
