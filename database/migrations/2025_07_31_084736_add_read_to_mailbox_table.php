<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mailbox', function (Blueprint $table) {
           $table->boolean('read')->default(0)->after('type'); // 0 = unread, 1 = read
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mailbox', function (Blueprint $table) {
             $table->dropColumn('read');
        });
    }
};
