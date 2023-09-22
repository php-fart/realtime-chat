<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefault15fdd10712e0915306f059240cb7b975 extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('threads')
        ->addColumn('id', 'primary', ['nullable' => false, 'default' => null])
        ->addColumn('name', 'string', ['nullable' => false, 'default' => null, 'size' => 255])
        ->setPrimaryKeys(['id'])
        ->create();
        $this->table('users')
        ->addColumn('id', 'primary', ['nullable' => false, 'default' => null])
        ->addColumn('username', 'string', ['nullable' => false, 'default' => null, 'size' => 255])
        ->addColumn('password', 'string', ['nullable' => false, 'default' => null, 'size' => 255])
        ->setPrimaryKeys(['id'])
        ->create();
        $this->table('messages')
        ->addColumn('id', 'primary', ['nullable' => false, 'default' => null])
        ->addColumn('message', 'string', ['nullable' => false, 'default' => null, 'size' => 255])
        ->addColumn('user_id', 'integer', ['nullable' => false, 'default' => null])
        ->addColumn('thread_id', 'integer', ['nullable' => false, 'default' => null])
        ->addIndex(['user_id'], ['name' => 'messages_index_user_id_650dcf5177957', 'unique' => false])
        ->addIndex(['thread_id'], ['name' => 'messages_index_thread_id_650dcf5177a95', 'unique' => false])
        ->addForeignKey(['user_id'], 'users', ['id'], [
            'name' => 'messages_foreign_user_id_650dcf517797b',
            'delete' => 'CASCADE',
            'update' => 'CASCADE',
            'indexCreate' => true,
        ])
        ->addForeignKey(['thread_id'], 'threads', ['id'], [
            'name' => 'messages_foreign_thread_id_650dcf5177aad',
            'delete' => 'CASCADE',
            'update' => 'CASCADE',
            'indexCreate' => true,
        ])
        ->setPrimaryKeys(['id'])
        ->create();
    }

    public function down(): void
    {
        $this->table('messages')->drop();
        $this->table('users')->drop();
        $this->table('threads')->drop();
    }
}
