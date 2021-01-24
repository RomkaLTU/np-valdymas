<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company_name');
            $table->enum('type', ['vat_payer', 'non_vat_payer'])->nullable();
            $table->string('code')->nullable();
            $table->string('vat_code')->nullable();
            $table->string('address')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('representative')->nullable();
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
        Schema::dropIfExists('sellers');
    }
}
