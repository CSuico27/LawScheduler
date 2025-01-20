<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ServicesType extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Services Management';
    // protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Service Type';
    protected static ?string $title = 'Service Type';

    protected static string $view = 'filament.pages.services-type';
}
