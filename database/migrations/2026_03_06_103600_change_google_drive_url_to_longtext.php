<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Change google_drive_url from VARCHAR(255) to LONGTEXT to support long URLs or multiple URLs
        DB::statement('ALTER TABLE galleries MODIFY google_drive_url LONGTEXT NULL');
        
        // Also change file_path to TEXT in case it's needed for Google Drive paths
        DB::statement('ALTER TABLE galleries MODIFY file_path TEXT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE galleries MODIFY google_drive_url VARCHAR(255) NULL');
        DB::statement('ALTER TABLE galleries MODIFY file_path VARCHAR(255) NULL');
    }
};
