<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id');
            $table->date('birthday')->nullable();
            $table->string('status', 50)->nullable();
            $table->text('description')->nullable();
            $table->integer('publications_count')->default(0);
            $table->integer('videos_count')->default(0);
            $table->integer('photo_count')->default(0);
            $table->integer('saved_track_count')->default(0);
            $table->boolean('is_banned')->default(0);
            $table->integer('admin_id')->default(0);
            $table->string('moderators_id')->nullable();
            $table->string('geolocation', 50)->nullable();
            $table->integer('subscriptions_count')->default(0);
            $table->integer('subscribers_count')->default(0);
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
        Schema::dropIfExists('profiles');
    }
}
