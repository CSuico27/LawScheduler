<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class CaseType extends Page
{
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static string $view = 'filament.pages.case-type';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->role == 'admin';
    }
}
