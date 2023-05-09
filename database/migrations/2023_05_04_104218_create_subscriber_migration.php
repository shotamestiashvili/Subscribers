<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Shared\Models\User::class)
                ->constrained()->cascadeOnDelete();
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->foreignId('form_id')
                ->constrained()->cascadeOnDelete();
            $table->dateTime('subscribed_at')->useCurrent();
            $table->timestamps();
            $table->unique(['user_id', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribers');
    }
};
