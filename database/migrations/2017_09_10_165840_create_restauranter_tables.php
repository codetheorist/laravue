<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestauranterTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( \Config::get( 'restauranter.users_table' ), function ( Blueprint $table )
        {
            $table->integer( 'current_restaurant_id' )->unsigned()->nullable();
        } );

        Schema::create( \Config::get( 'restauranter.restaurants_table' ), function ( Blueprint $table )
        {
            $table->increments( 'id' )->unsigned();
            $table->integer( 'owner_id' )->unsigned()->nullable();
            $table->boolean( 'enabled' )->unsigned()->default(0);
            $table->string( 'name' );
            $table->string( 'display_name' )->nullable();
            $table->string( 'description' )->nullable();
            $table->binary( 'opening_times' )->nullable();
            $table->integer( 'address_id' )->unsigned()->nullable();
            $table->timestamps();
        } );

        Schema::create( \Config::get( 'restauranter.restaurant_staff_table' ), function ( Blueprint $table )
        {
            $table->integer( 'user_id' )->unsigned();
            $table->integer( 'restaurant_id' )->unsigned();
            $table->timestamps();

            $table->foreign( 'user_id' )
                ->references( \Config::get( 'restauranter.user_foreign_key' ) )
                ->on( \Config::get( 'restauranter.users_table' ) )
                ->onUpdate( 'cascade' )
                ->onDelete( 'cascade' );

            $table->foreign( 'restaurant_id' )
                ->references( 'id' )
                ->on( \Config::get( 'restauranter.restaurants_table' ) )
                ->onDelete( 'cascade' );
        } );

        Schema::create( \Config::get( 'restauranter.restaurant_invites_table' ), function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('restaurant_id')->unsigned();
            $table->enum('type', ['invite', 'request']);
            $table->string('email');
            $table->string('accept_token');
            $table->string('deny_token');
            $table->timestamps();
            $table->foreign( 'restaurant_id' )
                ->references( 'id' )
                ->on( \Config::get( 'restauranter.restaurants_table' ) )
                ->onDelete( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(\Config::get( 'restauranter.users_table' ), function(Blueprint $table)
        {
            $table->dropColumn('current_restaurant_id');
        });

        Schema::table(\Config::get('restauranter.restaurant_staff_table'), function (Blueprint $table) {
            $table->dropForeign(\Config::get('restauranter.restaurant_staff_table').'_user_id_foreign');
            $table->dropForeign(\Config::get('restauranter.restaurant_staff_table').'_restaurant_id_foreign');
        });

        Schema::drop(\Config::get('restauranter.restaurant_staff_table'));
        Schema::drop(\Config::get('restauranter.restaurant_invites_table'));
        Schema::drop(\Config::get('restauranter.restaurants_table'));
    }
}
