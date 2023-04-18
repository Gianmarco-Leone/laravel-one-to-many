<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Aggiungo la colonna type_id alla table projects che contiene una foreign key
            $table->foreignId('type_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Elimino la foreign key
            $table->dropForeign('projects_type_id_foreign');
            // Elimino la colonna type_id
            $table->dropColumn('type_id');
        });
    }
};