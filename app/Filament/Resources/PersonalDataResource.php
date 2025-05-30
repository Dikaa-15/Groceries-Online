<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\PersonalData;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PersonalDataResource\Pages;
use App\Filament\Resources\PersonalDataResource\RelationManagers;

class PersonalDataResource extends Resource
{
    protected static ?string $model = PersonalData::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'User Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                TextInput::make('first_name')
                    ->label('First Name')
                    
                    ->required(),

                TextInput::make('last_name')
                    ->label('Last Name')
                    ->required(),

                Textarea::make('address')
                    ->label('Address')
                    ->required(),

                Select::make('gender')
                    ->label('Gender')
                    ->options([
                        'man' => 'Man',
                        'women' => 'Women',
                    ])
                    ->required(),

                DatePicker::make('date_of_birth')
                    ->label('Date of Birth')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('user.profile')->label('Profile')->circular(),
                TextColumn::make('user.name')->label('User'),
                TextColumn::make('first_name')->label('First Name'),
                TextColumn::make('last_name')->label('Last Name'),
                TextColumn::make('gender')->label('Gender'),
                TextColumn::make('date_of_birth')->label('Date of Birth')->date(),
                TextColumn::make('address')->label('Address')->limit(50),
                TextColumn::make('created_at')->label('Created At')->dateTime(),
            ])
            ->filters([
                Filter::make('male')
                    ->label('Only Men')
                    ->query(fn ($query) => $query->where('gender', 'man')),

                Filter::make('female')
                    ->label('Only Women')
                    ->query(fn ($query) => $query->where('gender', 'women')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPersonalData::route('/'),
            'create' => Pages\CreatePersonalData::route('/create'),
            'edit' => Pages\EditPersonalData::route('/{record}/edit'),
        ];
    }
}
