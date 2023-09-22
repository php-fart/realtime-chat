<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefaultB23179cabf9a59fc80298f8c5291872b extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('auth_tokens')
        ->addColumn('id', 'string', ['nullable' => false, 'default' => null, 'size' => 64])
        ->addColumn('hashed_value', 'string', ['nullable' => false, 'default' => null, 'size' => 128])
        ->addColumn('created_at', 'datetime', ['nullable' => false, 'default' => null])
        ->addColumn('expires_at', 'datetime', ['nullable' => true, 'default' => null])
        ->addColumn('payload', 'binary', ['nullable' => false, 'default' => null])
        ->setPrimaryKeys(['id'])
        ->create();
    }

    public function down(): void
    {
        $this->table('auth_tokens')->drop();
    }
}
