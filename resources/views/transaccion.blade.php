@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Datos de la Transacción</div>
        <div class="card-body">
            <form method="POST" action="{{ route('crearTransaccion') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-4" hidden>
                        <div class="form-group">
                            <label>{{ __('Tipo de Pago') }}</label>
                            <select class="form-control">
                                <option value="">Seleccione el tipo de pago</option>
                                <option value="0" selected>Tarjeta Debito</option>
                                <option value="1">Tarjeta Credito</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('Monto') }}</label>
                            <input type="number" class="form-control" name="bank[totalAmount]" min="0" max="1000000" value="12">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('Tipo de Cuenta') }}</label>
                            <select name="bank[bankInterface]" class="form-control">
                                <option value="">Seleccione el tipo de cuenta</option>
                                <option value="0" selected>Persona</option>
                                <option value="0" readonly>Compañia</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label >{{ __('Entidad Financiera') }}</label>
                            <select name="bank[bankCode]" class="form-control" required>
                                @foreach($bancos as $row)
                                    <option value="{{ $row->bankCode }}">{{ $row->bankName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('Tipo Documento') }}</label>
                            <select name="payer[documentType]" class="form-control">
                                <option value="">Selecciones el tipo de documento</option>
                                <option value="CC" selected>CC</option>
                                <option value="CE">Foreigner ID</option>
                                <option value="TI">Identity card</option>
                                <option value="PPN">Passport</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('Documento') }}</label>
                            <input name="payer[document]" type="number" min="0" class="form-control" value="1000533273">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('Nombres') }}</label>
                            <input name="payer[firstName]" type="text" class="form-control" value="David">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('Apellidos') }}</label>
                            <input name="payer[lastName]" type="text" class="form-control" value="Vásquez Osorio">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('Compañia') }}</label>
                            <input name="payer[company]" type="text" class="form-control" value="PlacetoPay">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('E-Mail') }}</label>
                            <input name="payer[emailAddress]" type="email" class="form-control" value="david.vasquez.osorio@gmail.com">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('Dirección') }}</label>
                            <input name="payer[address]" type="text" class="form-control" value="Cll 40 #26c-57">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('Ciudad') }}</label>
                            <input name="payer[city]" type="text" class="form-control" value="Medellín">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('Departamento') }}</label>
                            <input name="payer[province]" type="text" class="form-control" value="Antioquia">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('País') }}</label>
                            <input name="payer[country]" type="text" class="form-control" value="CO">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('Telefono Fijo') }}</label>
                            <input name="payer[phone]" type="text" class="form-control" value="2164124">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('Telefono Celular') }}</label>
                            <input name="payer[mobile]" type="text" class="form-control" value="3118794816">
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Aceptar') }}
                            </button>
                        </div>
                    </div>               
                    <div class="col-md-3"></div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
