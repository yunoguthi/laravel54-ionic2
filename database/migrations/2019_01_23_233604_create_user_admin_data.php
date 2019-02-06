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
        \App\Models\User::create([
          'name' => env('ADMIN_DEFAULT_NAME', 'Administrator'),
          'email' => env('ADMIN_DEFAULT_EMAIL', 'admin@mail.com'),
          'role' => \App\Models\User::ROLE_ADMIN,
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
        $user = \App\Models\User::where('email','=',env('ADMIN_DEFAULT_EMAIL'))->first();
        if ($user instanceof \App\Models\User) {
          $user->delete();
        }
    }
}
