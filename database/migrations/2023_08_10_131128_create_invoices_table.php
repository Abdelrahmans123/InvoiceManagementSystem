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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoiceNumber');
            $table->date('invoiceDate');
            $table->date('dueDate');
            $table->string('product');
            $table->bigInteger('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->decimal('amountCollection',8,2);
            $table->decimal('amountCommission',8,2);
            $table->decimal('discount',8,2);
            $table->string('rateVat');
            $table->decimal('valueVat',8,2);
            $table->decimal('total',8,2);
            $table->string('status', 50);
            $table->integer('valueStatus');
            $table->text('note')->nullable();
            $table->date('paymentDate')->nullable();
            $table->string('user');
            $table->softDeletes();
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
        Schema::dropIfExists('invoices');
    }
};
