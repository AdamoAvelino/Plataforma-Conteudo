<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->integer('cnpj')->unsigned()->nullable(false);
            $table->integer('telephone')->unsigned()->default(null);
            $table->string('email', 250)->nullable(false);
            $table->index(['cnpj', 'email']);
            $table->timestamps();
        });

        Schema::create('produce_editorial', function (Blueprint $table) {
            $table->integer('produce_id')->unsigned();
            $table->integer('editorial_id')->unsigned();
            $table->foreign('produce_id')
            ->references('id')
            ->on('produces')
            ->onDelete('cascade');
            $table->foreign('editorial_id')
            ->references('id')
            ->on('editorials')
            ->onDelete('cascade');
        });

        Schema::create('user_produce', function (Blueprint $table) {
            $table->integer('produce_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('produce_id')
            ->references('id')
            ->on('produces')
            ->onDelete('cascade');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::disableForeignKeyConstraints();

        Schema::table('produce_editorial', function(Blueprint $table) {
            $table->dropForeign('produce_editorial_produce_id_foreign');
            $table->dropForeign('produce_editorial_editorial_id_foreign');
        });

        Schema::table('user_produce', function(Blueprint $table) {
            $table->dropForeign('user_produce_produce_id_foreign');
            $table->dropForeign('user_produce_user_id_foreign');
        });

        Schema::dropIfExists('produces');
        Schema::dropIfExists('produce_editorial');
        Schema::dropIfExists('user_produce');

        Schema::enableForeignkeyConstraints();
    }
}
