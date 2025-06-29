<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;  // Asegúrate de importar el modelo Order
use Illuminate\Support\Facades\Log; // Para registrar errores

class OrderController extends Controller
{
    // Método para mostrar el formulario de creación de una nueva orden
    public function create()
    {
        return view('filament.pages.create-order');  // Esta es la nueva vista de creación
    }

    // Método para almacenar la nueva orden
    public function store(Request $request)
    {
        try {
            // Validación de los datos recibidos
            $request->validate([
                'customer_id' => 'required|exists:customers,id', // Aseguramos que el customer_id exista en la tabla 'customers'
                'total_price' => 'required|numeric|min:0', // Validamos que 'total_price' sea un número y mayor o igual a 0
                'payment_method' => 'required|string|in:efectivo,tarjeta,yape', // Método de pago permitido
            ]);

            // Calcular IGV (18%)
            $igv = $request->total_price * 0.18;

            // Crear una nueva orden
            $order = new Order();
            $order->customer_id = $request->customer_id;
            $order->total_price = $request->total_price;
            $order->payment_method = $request->payment_method;  // Guardar el medio de pago
            $order->igv = $igv;  // Guardar el IGV calculado
            $order->save(); // Guardamos la orden en la base de datos

            // Redirigir al listado de órdenes con un mensaje de éxito
            return redirect()->route('orders.index')->with('success', 'Orden creada con éxito');
        } catch (\Exception $e) {
            // Manejo de errores: registrar el error y redirigir con un mensaje
            Log::error('Error al crear la orden: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al crear la orden');
        }
    }
}
