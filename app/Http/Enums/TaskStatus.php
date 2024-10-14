<?php

namespace App\Http\Enums;

use App\Rules\Phone;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

enum TaskStatus: string
{
    use Enumable;

    case ASSIGNED = 'assigned';
    case IN_PROGRESS = 'in_progress';
    case IN_REVIEW = 'in_review';
    case DONE = 'done';

    public function t()
    {
        return match ($this) {
            self::ASSIGNED => __('general.assigned'),
            self::IN_PROGRESS => __('general.in_progress'),
            self::IN_REVIEW => __('general.in_review'),
            self::DONE => __('general.done'),
        };
    }
}
