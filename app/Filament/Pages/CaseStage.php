<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class CaseStage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-up';
    protected static ?string $navigationGroup = 'Case Management';
    protected static ?int $navigationSort = 2;
    protected static string $view = 'filament.pages.case-stage';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->role == 'admin';
    }
}
