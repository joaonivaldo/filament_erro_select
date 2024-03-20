<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@filamentphp.com',
        ]);

		DB::insert('INSERT INTO categorias (id, uuid, parent_id, slug, label, icon, ativo, created_at, updated_at, deleted_at) VALUES (1, "81fcc3b9-43e1-4645-8173-d33369fe784a", NULL, "pasta-1", "Pasta 1", "pastas/01HP4RVK4PZ7J31B4EHX2V1A01.png", 1, "2024-02-07 22:42:34", "2024-02-08 13:29:48", NULL);');
		DB::insert('INSERT INTO categorias (id, uuid, parent_id, slug, label, icon, ativo, created_at, updated_at, deleted_at) VALUES (2, "0993c547-5659-4754-adcf-524062f4a392", NULL, "pasta-2", "Pasta 2", "pastas/01HP382HZ1NDEN5KTETE1YPWRG.png", 1, "2024-02-07 22:45:10", "2024-02-07 23:17:16", NULL);');
		DB::insert('INSERT INTO categorias (id, uuid, parent_id, slug, label, icon, ativo, created_at, updated_at, deleted_at) VALUES (4, "7bf3360b-71c1-4bc6-af3c-1cdfc453b076", NULL, "pasta-3", "PAsta 3", "pastas/01HP37F26EV2AS134WMNQX26JC.png", 1, "2024-02-07 23:06:37", "2024-02-07 23:06:37", NULL);');
		DB::insert('INSERT INTO categorias (id, uuid, parent_id, slug, label, icon, ativo, created_at, updated_at, deleted_at) VALUES (5, "0a3beef6-2d1c-46e0-af7e-915435c9fbec", NULL, "pasta-4", "Pasta 4", NULL, 1, "2024-02-12 22:00:24", "2024-02-12 22:00:24", NULL);');
		DB::insert('INSERT INTO categorias (id, uuid, parent_id, slug, label, icon, ativo, created_at, updated_at, deleted_at) VALUES (7, "b8cbde8b-e4cf-440a-ab49-2599e37e5e6f", 1, "pasta-1-1", "Pasta 1-1", NULL, 1, "2024-03-14 17:56:59", "2024-03-14 17:56:59", NULL);');
		DB::insert('INSERT INTO categorias (id, uuid, parent_id, slug, label, icon, ativo, created_at, updated_at, deleted_at) VALUES (8, "930de297-14f4-47d4-8082-6b6a439a9aef", 2, "pasta-2-1", "Pasta 2-1", NULL, 1, "2024-03-14 17:57:18", "2024-03-14 17:57:18", NULL);');
		DB::insert('INSERT INTO categorias (id, uuid, parent_id, slug, label, icon, ativo, created_at, updated_at, deleted_at) VALUES (9, "b87f6c8d-f3fd-401c-833c-7cb13a982aa6", 1, "pasta-1-0", "Pasta 1", NULL, 1, "2024-03-14 17:57:55", "2024-03-14 17:57:55", NULL);');
		DB::insert('INSERT INTO categorias (id, uuid, parent_id, slug, label, icon, ativo, created_at, updated_at, deleted_at) VALUES (10, "cdecacd1-a9ca-48b7-88d0-acb02aae0c42", 5, "pasta-4-1", "Pasta 4-1", NULL, 1, "2024-03-15 09:58:08", "2024-03-15 09:58:08", NULL);');
		DB::insert('INSERT INTO categorias (id, uuid, parent_id, slug, label, icon, ativo, created_at, updated_at, deleted_at) VALUES (11, "2b6d4d06-6ced-4403-a37e-8cfac814b9a5", 4, "pasta-fulana", "pasta fulana", NULL, 1, "2024-03-15 15:23:42", "2024-03-15 15:23:42", NULL);');
		DB::insert('INSERT INTO categorias (id, uuid, parent_id, slug, label, icon, ativo, created_at, updated_at, deleted_at) VALUES (12, "a98734b8-08c0-43f5-94b8-0e2b740f4df5", 11, "ola_pai", "ola pai", NULL, 1, "2024-03-18 10:13:55", "2024-03-18 10:13:55", NULL);');
		DB::insert('INSERT INTO subpastas (id, uuid, parent_id, slug, label, icon, ativo, created_at, updated_at, deleted_at) VALUES (5, "7ac4e3ef-e07e-4420-8983-255db025e2c0", 10, "sub-4-1-1", "sub 4-1-1",  NULL, 1, "2024-03-19 16:37:19", "2024-03-19 16:37:19", NULL);');
    }
}
