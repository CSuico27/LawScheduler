<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class CaseStage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 3;
    protected static string $view = 'filament.pages.case-stage';
}
