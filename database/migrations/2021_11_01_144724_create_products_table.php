<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('genre_id')->unsigned();
            $table->foreign('genre_id') //外部キー制約
                  ->references('id')->on('genres') //genresテーブルのidを参照する
                  ->onDelete('cascade');  //genresが削除されたら紐付くpostsも削除
            $table->string('name');
            $table->string('image');
            $table->text('introduction');
            $table->integer('price');
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
