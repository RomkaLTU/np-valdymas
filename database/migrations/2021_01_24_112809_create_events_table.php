<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->enum('order_type', ['equipment_rent', 'entertainment_and_equipment_rent', 'equipment_rent_inplace']);
            $table->enum('region', ['vilnius', 'klaipeda']);
            $table->foreignId('seller_id')->constrained();

            $table->date('install_date')->nullable();
            $table->time('install_time_start')->nullable();
            $table->boolean('install_time_start_need_conf')->default(0);
            $table->time('install_time_end')->nullable();
            $table->boolean('install_time_end_need_conf')->default(0);

            $table->date('entertainment_date')->nullable();
            $table->time('entertainment_time_start')->nullable();
            $table->boolean('entertainment_time_start_need_conf')->default(0);
            $table->time('entertainment_time_end')->nullable();
            $table->boolean('entertainment_time_end_need_conf')->default(0);

            $table->date('uninstall_date')->nullable();
            $table->time('uninstall_time_start')->nullable();
            $table->boolean('uninstall_time_start_need_conf')->default(0);
            $table->time('uninstall_time_end')->nullable();
            $table->boolean('uninstall_time_end_need_conf')->default(0);

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
        Schema::dropIfExists('events');
    }
}
