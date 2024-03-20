<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
	use Uuid;

	protected $table = 'categorias';

	protected $fillable = [
		'parent_id',
		'label',
		'slug',
		'order',
		'icon',
		'ativo',
	];

	public function parent(): BelongsTo
	{
		return $this->belongsTo(self::class, 'parent_id');
	}

	public function children(): HasMany
	{
		return $this->hasMany(self::class, 'parent_id');
	}

	public function documentos(): HasMany
	{
		return $this->hasMany(Documento::class, 'folder_id', 'id');
	}

	public function subsubpastas(): HasMany
	{
		return $this->hasMany(SubPasta::class, 'parent_id', 'id');
	}
}