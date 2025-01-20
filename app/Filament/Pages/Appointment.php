<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Pages\Page;

class Appointment extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.pages.appointment';

}
