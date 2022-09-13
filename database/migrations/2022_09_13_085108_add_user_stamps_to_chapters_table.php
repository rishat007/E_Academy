<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserStampsToChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chapters', function (Blueprint $table) {
            //
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->softDeletes()->nullable();
            $table->foreignId('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chapters', function (Blueprint $table) {
            //
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropSoftDeletes();
            $table->dropColumn('deleted_by');
        });
    }
}
