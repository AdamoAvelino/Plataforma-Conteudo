<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->string('title', 100);
            $table->text('description');
            $table->string('image', 255)->nullable()->default(null);
            $table->integer('revisor')->unsigned()->nullable()->default(null);
            $table->timestamp('date_review')->nullable()->default(null);
            $table->integer('publisher')->unsigned()->nullable()->default(null);
            $table->timestamp('date_published')->nullable()->default(null);
            $table->timestamps();
            $table->index(['revisor', 'publisher', 'title']);
            $table->foreign('status_id')
            ->references('id')
            ->on('statuses')
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

        Schema::table('posts', function(Blueprint $table) {
            $table->dropForeign('posts_status_id_foreign');
            $table->dropForeign('posts_user_id_foreign');
        });

        Schema::dropIfExists('posts');

        Schema::enableForeignkeyConstraints();

    }
}
