<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBoasVindasEmailEnviadosTable extends Migration
{

    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('boasvindas_email_enviado')->default(false);
        });
    }


    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('boasvindas_email_enviado');
        });
    }
};
