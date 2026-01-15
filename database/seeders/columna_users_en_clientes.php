<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class columna_users_en_clientes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Schema::hasColumn('clientes', 'user_id')) {

            DB::statement("
                ALTER TABLE clientes
                ADD COLUMN user_id BIGINT NULL
            ");

            DB::statement("
                ALTER TABLE clientes
                ADD CONSTRAINT clientes_user_id_fk
                FOREIGN KEY (user_id)
                REFERENCES users(id)
                ON DELETE SET NULL
            ");
        }
    }
}
