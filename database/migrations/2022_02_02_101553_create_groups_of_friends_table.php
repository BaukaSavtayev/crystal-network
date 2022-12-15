<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsOfFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups_of_friends', function (Blueprint $table) {
            $table->integer('user_id')->unique();
            $table->string('best_friends')->default('');
            $table->string('family')->default('');
            $table->string('colleagues')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups_of_friends');
    }
}
