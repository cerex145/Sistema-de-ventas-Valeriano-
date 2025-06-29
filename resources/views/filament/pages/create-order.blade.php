@extends('layouts.app')  <!-- O la plantilla que estés usando -->

@section('content')
<div class="container">
    <h2>Crear Orden</h2>
    
    <!-- Formulario para crear una orden -->
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        
        <!-- Campo para seleccionar el cliente -->
        <div class="form-group">
            <label for="customer_id">Cliente:</label>
            <select class="form-control" id="customer_id" name="customer_id">
                <option value="">Selecciona un cliente</option>
                <!-- Aquí deberías agregar los clientes desde la base de datos -->
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Campo para el precio total -->
        <div class="form-group">
            <label for="total_price">Precio Total:</label>
            <input type="number" class="form-control" id="total_price" name="total_price" required>
        </div>

        <!-- Campo para seleccionar el medio de pago -->
        <div class="form-group">
            <label for="payment_method">Método de Pago:</label>
            <select class="form-control" id="payment_method" name="payment_method" required>
                <option value="efectivo">Efectivo</option>
                <option value="tarjeta">Tarjeta</option>
                <option value="yape">Yape</option>
            </select>
        </div>

        <!-- Botón para enviar el formulario -->
        <button type="submit" class="btn btn-primary">Crear Orden</button>
    </form>
</div>
@endsection
