<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname', 30)->after('name')->change();
            $table->boolean('online')->default(1)->after('name')->change();
            $table->string('phone_number', 30)->nullable()->after('name')->change();
            $table->string('rooms')->default('')->after('name')->change();
            $table->string('avatar', 150)->nullable()->after('name')->change();

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
