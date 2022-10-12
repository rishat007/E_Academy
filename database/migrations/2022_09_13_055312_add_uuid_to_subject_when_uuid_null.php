<?php

use App\Models\Subject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AddUuidToSubjectWhenUuidNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        {
            $subjects = Subject::all();
            foreach ($subjects as $subject) {
                $subject->uuid = Str::uuid();
                $subject->save();
            }
            Artisan::call('cache:clear');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('role_when_uuid_null', function (Blueprint $table) {
            //
        });
    }
}
