@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Transacción | Ticket - {{ substr($estadoTra->getReference(), 7) }}</h2><br>
    <h4 class="text-center">Estado de la solicitud: {{ $estadoTra->getReturnCode() }}</h4>
    <h2 class="text-center {{ $estadoTra->getResponseReasonText() == 'Aprobada'?'text-success':'text-danger' }}">
        {{ $estadoTra->getResponseReasonText()  }}
    </h2>
    <p class="text-center {{ $estadoTra->getTransactionState()=='OK'?'text-success':'text-danger' }}">{{ $estadoTra->getTransactionState() }}</p>

    </div>
</div>
@endsection