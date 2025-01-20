<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class CourtPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $navigationGroup = 'Case Management';
    protected static string $view = 'filament.pages.court-page';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Court';
    protected static ?string $title = 'Court';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->role == 'admin';
    }
}
