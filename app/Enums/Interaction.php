<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum Interaction: string implements HasLabel
{
    case TalkBack = 'talk_back';
    case Soundboard = 'soundboard';

    public function getLabel(): string|Htmlable|null
    {
        return $this->name;
    }
}
