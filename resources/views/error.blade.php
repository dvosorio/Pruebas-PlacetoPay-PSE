@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Error de transacción</h2><br>
    <p class="text-center text-danger"><strong>Error!</strong> {{ $error }}</p>
    <center>
        <a style="padding:center;" href="{{ route('transaccion')  }}" class="btn btn-link">Hacer una nueva prueba de pago</a>
    </center>
</div>
@endsection