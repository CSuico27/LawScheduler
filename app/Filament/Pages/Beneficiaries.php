<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Beneficiaries extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 0;
    protected static string $view = 'filament.pages.beneficiaries';
}
