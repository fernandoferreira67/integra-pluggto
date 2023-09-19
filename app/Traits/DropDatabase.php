<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait DropDatabase
{
    public function dropDatabase(): void
    {
        if ( ! property_exists($this, 'nome')) {
            throw new RuntimeException('Faltando o atributo nome para o retorno do slug.');
        }

        return;
    }
}
