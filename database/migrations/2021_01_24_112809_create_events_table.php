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
            $table->foreignId('client_id')->nullable()->constrained();

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

            $table->double('price', 10, 2)->nullable();
            $table->double('advance', 10, 2)->nullable();
            $table->boolean('need_contract')->default(1);

            $table->string('equipment_contact_number_in_place')->nullable();
            $table->string('equipment_address')->nullable();
            $table->integer('equipment_workers_montage')->nullable();
            $table->integer('equipment_workers_demontage')->nullable();
            $table->json('equipment_montage_ground')->nullable();

            $table->string('entertainment_address')->nullable();
            $table->string('entertainment_contact_number_in_place')->nullable();
            $table->integer('entertainment_workers')->nullable();
            $table->integer('entertainment_el_needs')->nullable();
            $table->json('entertainment_el_provider')->nullable();

            $table->json('equipment')->nullable();
            $table->json('accessories')->nullable();

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
