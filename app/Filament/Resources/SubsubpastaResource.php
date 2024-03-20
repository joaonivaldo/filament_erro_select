<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubsubpastaResource\Pages;
use App\Filament\Resources\SubsubpastaResource\RelationManagers;
use App\Models\Categoria;
use App\Models\SubPasta;
use App\Models\Subsubpasta;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class SubsubpastaResource extends Resource
{
    protected static ?string $model = SubPasta::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	public static function getEloquentQuery(): QueryBuilder
	{
		return parent::getEloquentQuery()->whereNotNull('parent_id');
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				Tables\Columns\TextColumn::make('id'),
				Tables\Columns\TextColumn::make('label')
					->label('Nome da Pasta')
					->sortable()
					->searchable(),
				Tables\Columns\TextColumn::make('parent.label')
					->label('Pastas Principal')
					->sortable()
					->searchable(),
				Tables\Columns\ToggleColumn::make('ativo')
					->label('Ativo')
					->sortable(),
				Tables\Columns\TextColumn::make('updated_at')
					->label('Atualizado em')
					->dateTime(),
			])
			->filters([
				Filter::make('folder')
					->form([
						Select::make('parent_id0')
							->required()
							->label('Pasta Principal')
							//->relationship('parent', 'label')
							->options(Categoria::query()->whereNull('parent_id')->pluck('label', 'id'))
							->searchable()
							->placeholder('Selecione uma pasta.')
							->loadingMessage('Carregando. Aguarde...')
							->noSearchResultsMessage('Sem registros...')
							->searchPrompt('Selecione uma pasta.')
							->searchingMessage('Procurando...')
							->preload()
							->columnSpan(1)
							->live(),

						Select::make('parent_id1')
							->required()
							->label('Sub pasta principal')
							->options(function (Get $get) {
								return Categoria::query()->where('parent_id', $get('parent_id0'))->pluck('label', 'id');
							})
							->searchable()
							->placeholder('Selecione uma pasta.')
							->loadingMessage('Carregando. Aguarde...')
							->noSearchResultsMessage('Sem registros...')
							->searchPrompt('Selecione uma pasta.')
							->searchingMessage('Procurando...')
							->columnSpan(1)
							->live()
							->preload(),
					])
					->columns(2)
					->query(function (Builder $query, array $data): Builder {
						return $query
							->when(
								$data['parent_id1'],
								function (Builder $query) use ($data): Builder {
									return $query->where('parent_id', $data['parent_id1']);
								},
							);
					}),
			], layout: FiltersLayout::AboveContent)
			->persistFiltersInSession()
			->filtersFormColumns(2)
			->filtersFormWidth(MaxWidth::FourExtraLarge)
			->actions([
				Tables\Actions\EditAction::make()
					->mutateFormDataUsing(function (array $data): array {
						$slug = Str::slug($data['label']);
						$i = 0;
						while (Categoria::query()->where('slug', $slug)->exists()) {
							$slug = Str::slug($data['label']) . '-' . $i;
							$i++;
						}

						$data['slug'] = $slug;

						return $data;
					}),
			])
			->bulkActions([]);
	}

	public static function form(Form $form): Form
	{
		return $form
			->schema([
				Forms\Components\Grid::make([
					'default' => 1,
					/*'sm'      => 2,
					'md'      => 2,
					'lg'      => 2,
					'xl'      => 2,
					'2xl'     => 2,*/
				])->schema([
					Forms\Components\Grid::make(['default' => 1])->schema([
						Forms\Components\Group::make([
							Select::make('parent_id')
								->required()
								->label(fn(Model $record): string => 'Pasta Principal..: ' . $record->parent->label)
								->relationship(
									'parent',
									'label',
									modifyQueryUsing: fn(Builder $query) => $query->whereNull('parent_id')
								)
								->searchable()
								->placeholder('Selecione uma pasta.')
								->loadingMessage('Carregando. Aguarde...')
								->noSearchResultsMessage('Sem registros...')
								->searchPrompt('Selecione uma pasta.')
								->searchingMessage('Procurando...')
								->preload()
								->live()
								->columnSpanFull(),
						])->relationship('subpasta'),
						/*Select::make('subpasta.parent_id')
							->required()
							->label(fn(Model $record): string => 'Pasta Principal: ' . $record->subpasta->parent_id)
							->relationship(
								'subpasta.parent',
								'label',
								modifyQueryUsing: fn(Builder $query) => $query->whereNull('parent_id')
							)
							//->options(Categoria::query()->whereNull('parent_id')->pluck('label', 'id'))
							->searchable()
							->placeholder('Selecione uma pasta.')
							->loadingMessage('Carregando. Aguarde...')
							->noSearchResultsMessage('Sem registros...')
							->searchPrompt('Selecione uma pasta.')
							->searchingMessage('Procurando...')
							->preload()
							->live()
							->columnSpanFull(),*/

						Select::make('parent_i0d')
							->required()
							->label('Sub pasta principal')
							//->relationship(titleAttribute: 'label')
							->options(function (Get $get) {
								return Categoria::query()->where('parent_id', $get('parent_id'))->pluck('label', 'id');
							})
							->searchable()
							->placeholder('Selecione uma pasta.')
							->loadingMessage('Carregando. Aguarde...')
							->noSearchResultsMessage('Sem registros...')
							->searchPrompt('Selecione uma pasta.')
							->searchingMessage('Procurando...')
							->preload()
							->columnSpanFull(),

						Forms\Components\TextInput::make('label')
							->label('Nome da pasta')
							->required()
							->string()
							//->unique(ignoreRecord: true)
							->maxLength(100),

						ToggleButtons::make('ativo')
							->label('Ativo?')
							->boolean()
							->inline()
							->default(true)
							->required(),

					])->columnSpan(1),
				]),
			]);
	}

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSubsubpastas::route('/'),
        ];
    }
}
