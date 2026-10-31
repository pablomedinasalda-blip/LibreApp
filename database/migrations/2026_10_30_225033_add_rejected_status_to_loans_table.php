
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("
                ALTER TABLE loans
                MODIFY status ENUM(
                    'pending',
                    'active',
                    'returned',
                    'overdue',
                    'rejected'
                ) NOT NULL DEFAULT 'pending'
            ");
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("
                ALTER TABLE loans
                MODIFY status ENUM(
                    'pending',
                    'active',
                    'returned',
                    'overdue'
                ) NOT NULL DEFAULT 'pending'
            ");
        }
    }
};
