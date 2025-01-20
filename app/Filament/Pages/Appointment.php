<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Appointment extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.pages.appointment';
}
