<?php
namespace App\Filament\Resources\MakulResource\Pages;

use App\Filament\Resources\MakulResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Form;

class CreateMakul extends CreateRecord
{
    protected static string $resource = MakulResource::class;

    protected function afterSave()
    {
        // Setelah menyimpan data, alihkan ke halaman detail makul berdasarkan kode_makul
        return redirect()->route('filament.resources.makuls.edit', [
            'record' => $this->record->kode_makul
        ]);
    }
}
