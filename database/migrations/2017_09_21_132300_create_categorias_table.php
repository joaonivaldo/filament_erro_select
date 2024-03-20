<?php

use App\Enumerations\SimNaoEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasTable extends Migration
{

	public function up(): void
	{
		Schema::create('categorias', function (Blueprint $table) {
			$table->increments('id');
			$table->uuid('uuid');
			$table->integer('parent_id')->unsigned()->nullable()->default(NULL);
			$table->string('slug', 100)->unique();
			$table->string('label', 100);
			$table->integer('order')->default(0);
			$table->string('icon', 255)->nullable();
			$table->unsignedSmallInteger('ativo')->default(1);
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('parent_id')
				->references('id')
				->on('categorias')
				->onDelete('set null');
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('categorias');
	}
}