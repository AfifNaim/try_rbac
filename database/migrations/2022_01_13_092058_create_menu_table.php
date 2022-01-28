<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_parent')->nullable();
            $table->string('judul', 100);
            $table->string('url', 255)->nullable();
            $table->unsignedBigInteger('id_hak_akses')->nullable();
            $table->timestamps();

            $table->index('id_parent');
            $table->index('id_hak_akses');

            $table->foreign('id_hak_akses')
                ->references('id')
                ->on('permissions')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreign('id_parent')
                ->references('id')
                ->on('menu')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
