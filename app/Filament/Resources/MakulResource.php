<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MakulResource\Pages;
use App\Models\Makul;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\NumberInput;
use Filament\Tables\Columns\TextColumn;

class MakulResource extends Resource
{
    protected static ?string $model = Makul::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('kode_makul')
                ->label('Kode Mata Kuliah')
                ->required()
                ->unique(table: Makul::class, column: 'kode_makul') // Tambahkan nama tabel dan kolom
                ->maxLength(5),
            TextInput::make('nama_makul')
                ->label('Nama Mata Kuliah')
                ->required()
                ->maxLength(128),
            TextInput::make('sks')
                ->label('Jumlah SKS')
                ->required()
                ->numeric() // Validasi input agar hanya menerima angka
                ->minValue(1) // Nilai minimum 1
                ->maxValue(8), // Nilai maksimum 8
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_makul')->label('Kode Mata Kuliah')->sortable()->searchable(),
                TextColumn::make('nama_makul')->label('Nama Mata Kuliah')->sortable()->searchable(),
                TextColumn::make('sks')->label('SKS')->sortable(),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMakuls::route('/'),
            'create' => Pages\CreateMakul::route('/create'),
            'edit' => Pages\EditMakul::route('/{record}/edit'),
        ];
    }
}
