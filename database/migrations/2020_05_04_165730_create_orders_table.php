<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable(); // Relación con clientes, puede ser null
            $table->decimal('total_price', 8, 2); // Precio total de la orden
            $table->decimal('payment_method', 50);  // Nueva columna para el medio de pago
            $table->decimal('igv', 8, 2);           // Nueva columna para el IGV (Impuesto General a las Ventas)
            $table->decimal('discount_price', 8, 2)->nullable(); // Precio con descuento, puede ser null
            $table->timestamps(); // Marca de tiempo de creación y actualización
            
            // Relación de clave foránea, referencia a la tabla 'customers'
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
        });
    }

    /**
     * Revertir las migraciones.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders'); // Eliminar la tabla 'orders' si existe
    }
};
