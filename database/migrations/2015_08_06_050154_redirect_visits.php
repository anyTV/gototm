<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RedirectVisits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redirect_rules', function($collection)
        {
            $collection->index('_id');
            $collection->string('ip_address');
            $collection->string('browser');
            $collection->string('platform');
            $collection->string('country');
            $collection->string('browser_version');
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('redirect_visits');
    }
}
