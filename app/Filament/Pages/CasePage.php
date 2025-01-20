<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class CasePage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-scale';
    protected static ?string $navigationLabel = 'Case';
    protected static ?string $title = 'Case';
    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.pages.case-page';
}
