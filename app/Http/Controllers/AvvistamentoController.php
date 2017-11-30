<?php

namespace App\Http\Controllers;

use App\Avvistamento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AvvistamentoController extends Controller
{
    /**
     * Restituisce tutte gli avvistamenti
     */
    public function avvistamenti(){
        $avvistamenti= Avvistamento::all();

        if(count($avvistamenti)==0)
            return response()->json('nessun avvistamento', 500);

        return response()->json($avvistamenti,200);
    }

    public function avvistamento(Request $request){
        $avvistamento= Avvistamento::find($request->id);
        if(is_null($avvistamento))
            return response()->json('nessuna avvistamento con id:'.$request->id, 500);
        $app = json_decode($avvistamento, true);

        $app['updated_at']=$avvistamento->updated_at->format('d/m/Y H:m:s');

        return response()->json($app,200);
    }

    public function inserisciavvistamento(Request $request){

        $avvistamento = new Avvistamento();

        $avvistamento->updated_at=Carbon::now(2)->toDateTimeString();
        $avvistamento->user_id=$request->user_id;
        $avvistamento->foto=$request->foto;
        $avvistamento->commento=$request->commento;

        if ($avvistamento->save())
            return response()->json($avvistamento, 200);
        return response()->json('errore', 500);
    }

    public function modificaavvistamento(Request $request){

        $avvistamento = avvistamento::find($request->id);
        if(is_null($avvistamento))
            return response()->json('nessuna avvistamento con id:'.$request->id, 500);

        $avvistamento->updated_at=Carbon::now(2)->toDateTimeString();
        $avvistamento->user_id=$request->user_id;
        $avvistamento->foto=$request->foto;
        $avvistamento->commento=$request->commento;


        if ($avvistamento->save())
            return response()->json($avvistamento, 200);
        return response()->json('errore', 500);
    }

    public function eliminaavvistamento(Request $request){

        $avvistamento = avvistamento::find($request->id);
        if(is_null($avvistamento))
            return response()->json('nessuna avvistamento con id:'.$request->id, 500);

        if ($avvistamento->delete())
            return response()->json($avvistamento, 200);
        return response()->json('errore', 500);
    }


}
