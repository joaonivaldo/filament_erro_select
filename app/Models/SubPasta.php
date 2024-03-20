<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubPasta extends Model
{
	use  Uuid;

	protected $table = 'subpastas';

	protected $fillable = [
		'parent_id',
		'label',
		'slug',
		'order',
		'icon',
		'ativo',
	];

	public function subpasta(): BelongsTo
	{
		return $this->belongsTo(Categoria::class, 'parent_id');
	}

	public function documentos(): HasMany
	{
		return $this->hasMany(Documento::class, 'folder_id', 'id');
	}
}