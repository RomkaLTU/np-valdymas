<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->enum('type', [
                'personal',
                'company',
            ])->default('company');
            $table->string('company_name')->nullable();
            $table->string('company_code')->nullable();
            $table->string('company_vat_code')->nullable();
            $table->string('company_address')->nullable();
            $table->string('responsible_person_role')->nullable();
            $table->string('responsible_person_name')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
