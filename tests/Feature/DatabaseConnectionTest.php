<?php
namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DatabaseConnectionTest extends TestCase
{
    public function test_database_connection()
    {
        try {
            DB::connection()->getPdo();
            $this->assertTrue(true, 'Database connection successful');
        } catch (\Exception $e) {
            $this->fail('Database connection failed: ' . $e->getMessage());
        }
    }

    public function test_user_table_exists()
    {
        $this->assertTrue(
            Schema::hasTable('users'),
            'Users table does not exist'
        );
    }
}
