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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100) ;
            $table->text('message');
            $table->enum('order' , ['suggestion' , 'complaint'] );
            $table->string('student_university_id' , 20);
            $table->string('student_name' , 45);
            $table->string('student_email' , 45)->unique();

            $table->enum('status' , ['open' , 'closed' ])->default('open');
            $table->string('image' , 150)->nullable();
            $table->boolean('urgent')->default(false);

            $table->timestamp('closed_date')->nullable();
            $table->text('response')->nullable();
            // $table->timestamp('email_verified_at');
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
        Schema::dropIfExists('orders');
    }
};
