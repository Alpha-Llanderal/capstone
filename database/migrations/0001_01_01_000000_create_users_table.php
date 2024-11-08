<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Use id() instead of increments('id')
            $table->string('first_name'); // snake_case
            $table->string('last_name'); // snake_case
            $table->string('email')->unique();
            $table->string('password');
            $table->date('birth_date')->nullable(); // snake_case
            $table->string('profile_picture')->nullable(); // snake_case
            $table->boolean('is_self_pay')->default(false); // snake_case with is_ prefix for boolean
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable(); // snake_case
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

// If you need a separate migration for adding a column
class AddProfilePictureToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_picture')->nullable(); // snake_case
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_picture');
        });
    }
}