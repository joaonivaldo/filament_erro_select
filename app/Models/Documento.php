<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Documento extends Model
{
	use Uuid;

	protected $fillable = [
		'uuid',
		'filename',
		'original_name',
		'mime',
		'extension',
		'size',
		'title',
		'description',
		'folder_id',
		'empresa_id',
		'protected_root',
		'protected_admin',
		'dono_id',
	];

	protected $attributes = [
		'protected_root'  => false,
		'protected_admin' => false,
		'folder_id'       => 0,
		'empresa_id'      => 0,
	];

	protected $casts = [
		'uuid'            => 'string',
		'protected_root'  => 'boolean',
		'protected_admin' => 'boolean',
		'dono_id'         => 'integer',
	];

	public function folder(): BelongsTo
	{
		return $this->belongsTo(Categoria::class, 'folder_id', 'id');
	}
}
