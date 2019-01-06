<?php

namespace app\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;
use Oveland\Placetopay\PlaceToPay;
use Oveland\Placetopay\Transaction\PSETransactionRequest;
use Oveland\Placetopay\Transaction\PSETransactionResponse;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('home');
    }

    public function vistaT()
    {
        $obj = new PlaceToPay();
        $bancos = $obj->getBankList();
        return view('transaccion', compact('bancos'));
    }

    public function crear(Request $datos)
    {
        $ticket = 'token?='.uniqid(rand(99, 99999999));
        $values = $datos->all();
        // $rute_host = 'http://web.placetopay.lc/informacion/'.$ticket;
        // $rute_local = 'http://localhost/informacion/'.$ticket;
        $rute_laravel = 'http://localhost:8000/informacion/'.$ticket;
        $values['bank']['returnURL'] = $rute_laravel;
        $values['bank']['reference'] = $ticket;
        $values['bank']['description'] = 'Prueba PSE';
        $values['bank']['language'] = 'ES';
        $values['bank']['currency'] = 'USD';
        $values['bank']['taxAmount'] = $values['bank']['totalAmount'] * 0.19;
        $values['bank']['devolutionBase'] = 0;
        $values['bank']['tipAmount'] = 0;
        
        $obj = new PlaceToPay();
        $transac = $obj->createTransaction($values);
        if ($transac->getReturnCode() == 'SUCCESS') {
            $this->establecerSesionTransaccion($ticket, $transac);
            return redirect(url($transac->getBankURL()));
        }
        $error = $transac->getResponseReasonText();
        return view('error', compact('error'));
    }

    public function informacionTransaccion($ticket)
    {
        $transac = $this->obtenerSesionTransaccion($ticket);
        if (!$transac->getSessionID()) {
            $error = 'No hay transacción en la sesión para el número de referencia.';
            return view('error', compact('error'));
        }
        $obj = new PlaceToPay();
        $estadoTra = $obj->obtenerSesionTransaccion($transac->getSessionID());
        return view('transaccion_men', compact('estadoTra'));
    }

    public function establecerSesionTransaccion($ticket, PSETransactionResponse $pseTransac)
    {
        $transac = session('transac');
        $transac[$ticket] = $pseTransac->getData();
        session(['transac' => $transac]);
    }

    public function obtenerSesionTransaccion($ticket = null)
    {
        $sesionTansac = session('transac');
        return new PSETransactionResponse(isset($sesionTansac[$ticket]) ? $sesionTansac[$ticket] : null);
    }

}
