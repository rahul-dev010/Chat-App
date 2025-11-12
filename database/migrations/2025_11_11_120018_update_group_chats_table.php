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
        // यहाँ group_chats टेबल को मॉडिफाई या क्रिएट करें 
        Schema::table('group_chats', function (Blueprint $table) {
            // यदि group_id कॉलम नहीं है, तो जोड़ें
            if (!Schema::hasColumn('group_chats', 'group_id')) {
                $table->foreignId('group_id')->constrained('groups')->onDelete('cascade')->after('id');
            }
            // user_id, message, created_at/updated_at कॉलम होने चाहिए
            // यदि आपके टेबल में user_name है, तो उसे हटा दें और user_id पर निर्भर रहें
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // ... (Optional)
    }
};