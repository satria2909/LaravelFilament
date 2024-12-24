<?php

namespace App\Filament\Pages;

use App\Models\Dosen;
use App\Models\Makul;
use Filament\Pages\Page;
use Illuminate\Support\Collection;

class LaporanDosenMakul extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.laporan-dosen-makul';

    protected static ?string $navigationLabel = 'Laporan Dosen & Makul';
    protected static ?string $title = 'Laporan Data Dosen dan Mata Kuliah';

     // Tambahkan script ini
     protected static ?string $navigationGroup = 'Laporan';

    public function getData(): Collection
    {
        return Dosen::with('makul')->get(); // Relasi makul diasumsikan sudah ada
    }
}
