<?php
/** @noinspection PhpUnused */

use App\Support\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

final class CreateUserTable extends Migration
{
    public function up(): void
    {
        $this->schema->create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('active')->default(false);
            $table->string('username')->unique()->index();
            $table->string('email')->unique()->index();
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $this->schema->dropIfExists('users');
    }
}
