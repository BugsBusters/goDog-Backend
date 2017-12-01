<?php

namespace App\Http\Controllers;

use App\Inserzione;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InserzioneController extends Controller
{

    /**
     * Restituisce tutte le inserzioni con la data in formato italiano
     */
    public function inserzioni(){
        $inserzioni= Inserzione::all();
        if(count($inserzioni)==0)
            return response()->json('nessuna inserzione', 500);
        $i=0;
        $app=array();
        foreach ($inserzioni as $item)
        {
          $app[$i] = json_decode($item, true);
          $app[$i]['updated_at']=$item->updated_at->format('d-m-Y H:m:s');
          $i++;
        }

        return response()->json($app,200);
    }

    /**
     * Restituisce l'iserzione con id passato come parametro con la data in formato italiano
     *
     * @var Request
     */
    public function inserzione(Request $request){
        $inserzione= Inserzione::find($request->id);
        if(is_null($inserzione))
            return response()->json('nessuna inserzione con id:'.$request->id, 500);
        $app = json_decode($inserzione, true);

        $app['updated_at']=$inserzione->updated_at->format('d/m/Y H:m:s');

        return response()->json($app,200);
    }

    public function inserzionebytipo($tipo) {
        $inserzione = Inserzione::where('tipoinserzione_id', $tipo)->get();

        if(count($inserzione))
            return response()->json('nessuna inserzione di questo tipo:'.$tipo, 500);

        if (!is_null($inserzione))
            return response()->json($inserzione, 200);
        return response()->json('errore', 500);
    }


    /**
     * Crea una nuova inserzione in base ai dati della request
     *
     * @var Request
     */
    public function inseriscinserzione(Request $request){

        $inserzione = new Inserzione();

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


    /**
     * Aggiorna una inserzione già esistente in base all'id usando i dati passati tramite request se non la trova ne crea una nuova
     *
     * @var Request
     */
    public function modificainserzione(Request $request){

        $inserzione = Inserzione::find($request->id);
        if(is_null($inserzione))
            return response()->json('nessuna inserzione con id:'.$request->id, 500);

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


    /**
     * Elimina un'inserzione un base all'id
     *
     * @var Request
     */
    public function eliminainserzione(Request $request){

        $inserzione = Inserzione::find($request->id);
        if(is_null($inserzione))
            return response()->json('nessuna inserzione con id:'.$request->id, 500);

        if ($inserzione->delete())
            return response()->json($inserzione, 200);
        return response()->json('errore', 500);
    }
}
