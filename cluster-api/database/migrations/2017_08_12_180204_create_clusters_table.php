<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClustersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clusters', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('level'); // curiosity, ...
            $table->boolean('status'); // 'actif', 'inactif'
            $table->boolean('open');
            $table->integer('type'); // 'strict' - 'semi strict' - 'free'
            $table->mediumText('description')->nullable();
            $table->json('options')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
