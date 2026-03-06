<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->string('google_drive_url')->nullable()->after('file_path');
            $table->enum('source', ['upload', 'gdrive'])->default('upload')->after('google_drive_url');
            $table->string('file_path')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn(['google_drive_url', 'source']);
            $table->string('file_path')->nullable(false)->change();
        });
    }
};
