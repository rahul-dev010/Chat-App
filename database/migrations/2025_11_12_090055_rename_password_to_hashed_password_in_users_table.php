<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * माइग्रेशन चलाएँ (Run the migrations).
     */
    public function up(): void
    {
        // मौजूदा 'password' कॉलम का नाम बदलकर 'hashed_password' कर रहे हैं।
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('password', 'hashed_password');
        });
    }

    /**
     * माइग्रेशन को रोलबैक करें (Reverse the migrations).
     */
    public function down(): void
    {
        // नाम को वापस 'password' पर बदल रहे हैं।
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('hashed_password', 'password');
        });
    }
};