<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMetaToRepairServiceCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('repair_service_categories', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('image')->nullable();
            $table->string('meta_keyword')->nullable()->after('meta_title')->nullable();
            $table->string('meta_description')->nullable()->after('meta_keyword')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('repair_service_categories', function (Blueprint $table) {
         $table->dropColumn('meta_title');
         $table->dropColumn('meta_keyword');
         $table->dropColumn('meta_description');
        });
    }
}
