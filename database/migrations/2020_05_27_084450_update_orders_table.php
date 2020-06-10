<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string("user_name")->after("user_id");
            $table->text("address")->after("user_id");
            $table->string("telephone")->after("user_id");
            $table->text("note")->after("user_id")->nullable();
            $table->unsignedBigInteger("status")->default(0)->after("grand_total");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn("user_name");
            $table->dropColumn("address");
            $table->dropColumn("telephone");
            $table->dropColumn("note");
            $table->dropColumn("status");
        });
    }
}
