<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatProductViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stat_product_views', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->integer('view');
            $table->datetime('ondate');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['deleted_at', 'ondate', 'product_id']);
            $table->index(['deleted_at', 'ondate', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stat_product_views');
    }
}
