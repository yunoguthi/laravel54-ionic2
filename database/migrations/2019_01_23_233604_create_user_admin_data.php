<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAdminData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\User::create([
          'name' => env('ADMIN_DEFAULT_NAME', 'Administrator'),
          'email' => env('ADMIN_DEFAULT_EMAIL', 'admin@mail.com'),
          'role' => \App\User::ROLE_ADMIN,
          'password' => bcrypt(env('ADMIN_DEFAULT_PASSWORD', 'secret'))
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $user = User::where('email','=',env('ADMIN_DEFAULT_EMAIL'))->first();
        if ($user instanceof \App\User) {
          $user->delete();
        }
    }
}
