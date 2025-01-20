<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class CourtTypePage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'Case Management';
    protected static string $view = 'filament.pages.court-type-page';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Court Type';
    protected static ?string $title = 'Court Type';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->role == 'admin';
    }
}
