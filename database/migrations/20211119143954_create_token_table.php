<?php
/** @noinspection PhpUnused */

use App\Support\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

final class CreateTokenTable extends Migration
{
    public function up(): void
    {
        $this->schema->create('tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('references');
            $table->string('token');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        $this->schema->dropIfExists('tokens');
    }
}
