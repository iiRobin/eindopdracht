<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInfoToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('residence', 255)->nullable()->after('settings');
            $table->string('workplace', 255)->nullable()->after('residence');
            $table->string('school', 255)->nullable()->after('workplace');
            $table->string('birthplace', 255)->nullable()->after('school');
            $table->string('relationship', 255)->nullable()->after('birthplace');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('residence');
            $table->dropColumn('workplace');
            $table->dropColumn('school');
            $table->dropColumn('birthplace');
            $table->dropColumn('relationship');
        });
    }
}
