<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * माइग्रेशन चलाएँ (Run the migrations).
     *
     * WARNING: इस 'password' कॉलम का उपयोग सादे (unhashed) पासवर्ड को स्टोर करने के लिए न करें।
     * सुरक्षा के लिए हमेशा 'hashed_password' का उपयोग करें।
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // एक नया 'password' कॉलम जोड़ना। इसे nullable रखा गया है।
            $table->string('password')->nullable()->after('email'); 
        });
    }

    /**
     * माइग्रेशन को रोलबैक करें (Reverse the migrations).
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('password');
        });
    }
};