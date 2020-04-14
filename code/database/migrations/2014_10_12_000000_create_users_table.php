<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->nullable(false);
            $table->string('email', 150)->unique()->nullable(false);
            $table->mediumInteger('telephone')->nullable()->default(null);
            $table->mediumInteger('cpf')->unique()->nullable()->default(null);
            $table->mediumInteger('cnpj')->unique()->nullable()->default(null);
            $table->string('photo',400)->nullable()->default(null);
            $table->smallInteger('active')->nullable(false)->default(1);
            $table->string('password')->nullable(false);
            $table->index(['cnpj', 'cpf', 'name', 'email']);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
