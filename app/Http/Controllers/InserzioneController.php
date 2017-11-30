<?php

namespace App\Http\Controllers;

use App\Inserzione;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InserzioneController extends Controller
{
    public function inserzioni(){
        $inserzioni= Inserzione::all();

        //app = json_decode($inserzioni, true);
        //return $app;
        $i=0;
        $app=array();
        foreach ($inserzioni as $item)
        {
          $app[$i] = json_decode($item, true);
          $app[$i]['updated_at']=$item->updated_at->format('d/m/Y H:m:s');
          $i++;
        }

        return response()->json($app,200);
    }

    public function inserzione(Request $request){
        $inserzione= Inserzione::find($request->id);
        $app = json_decode($inserzione, true);

        $app['updated_at']=$inserzione->updated_at->format('d/m/Y H:m:s');

        return response()->json($app,200);
    }

    public function inseriscinserzione(Request $request){

        $inserzione = new Inserzione();

        $inserzione->inserzionable_type=$request->inserzionable_type;
        $inserzione->inserzionable_id=$request->inserzionable_id;
        $inserzione->contenuto=$request->contenuto;
        $inserzione->indirizzo_id=$request->indirizzo_id;
        $inserzione->tipoinserzione_id=$request->tipoinserzione_id;
        $inserzione->fotopath=$request->fotopath;

        if ($inserzione->save())
            return response()->json($inserzione, 200);
        return response()->json('errore', 500);
    }


    public function modificainserzione(Request $request){

        $inserzione = Inserzione::find($request->id);

        $inserzione->updated_at=Carbon::now(2)->toDateTimeString();
        $inserzione->inserzionable_type=$request->inserzionable_type;
        $inserzione->inserzionable_id=$request->inserzionable_id;
        $inserzione->contenuto=$request->contenuto;
        $inserzione->indirizzo_id=$request->indirizzo_id;
        $inserzione->tipoinserzione_id=$request->tipoinserzione_id;
        $inserzione->fotopath=$request->fotopath;

        if ($inserzione->save())
            return response()->json($inserzione, 200);
        return response()->json('errore', 500);
    }

    public function eliminainserzione(Request $request){

        $inserzione = Inserzione::find($request->id);

        if ($inserzione->delete())
            return response()->json($inserzione, 200);
        return response()->json('errore', 500);
    }
}
