<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ServicesPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?string $navigationGroup = 'Services Management';
    // protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Services';
    protected static ?string $title = 'Services';

    protected static string $view = 'filament.pages.services-page';
}
