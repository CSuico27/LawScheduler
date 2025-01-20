<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Invoice extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.pages.invoice';
}
