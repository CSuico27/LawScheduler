<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class CaseSubType extends Page
{
    
    protected static ?string $navigationGroup = 'Case Management';
    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';
    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.pages.case-sub-type';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->role == 'admin';
    }
}
