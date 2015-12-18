<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class BalinUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'balin:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update BALIN.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $result         = $this->update();
        
        return true;
    }

    /**
     * update 1st version
     *
     * @return void
     * @author 
     **/
    public function update()
    {
        Schema::create('stat_category_views', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();
            $table->integer('view');
            $table->datetime('ondate');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['deleted_at', 'ondate', 'category_id']);
            $table->index(['deleted_at', 'ondate', 'user_id']);
        });

        $this->info("Add stat category views - table");

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
        
        $this->info("Add stat product views - table");

        Schema::table('user_campaign', function (Blueprint $table) {
            $table->integer('voucher_id')->unsigned()->index();
        });

        $this->info("Add voucher id in user campaign - table");
    }
}
