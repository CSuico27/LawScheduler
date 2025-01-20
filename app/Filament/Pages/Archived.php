<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Archived extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationGroup = 'Case Management';
    protected static ?int $navigationSort = 5;
    protected static string $view = 'filament.pages.archived';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->role == 'admin';
    }
}
