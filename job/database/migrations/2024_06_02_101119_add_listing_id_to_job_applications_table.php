<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddListingIdToJobApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->unsignedBigInteger('listing_id')->nullable()->after('user_id');

            // Assuming you have a listings table
            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->dropForeign(['listing_id']);
            $table->dropColumn('listing_id');
        });
    }
}
