<?php

namespace App\Http\Controllers;

use App\Indirizzo;
use Illuminate\Http\Request;

class IndirizzoController extends Controller
{
    public function getall(){
        $indirizzi = Indirizzo::all();


        if (!is_null($indirizzi))
            return response()->json($indirizzi, 200);
        return response()->json('errore', 500);
    }

    public function getById($id) {
        $indirizzo = Indirizzo::find($id);


        if (!is_null($indirizzo))
            return response()->json($indirizzo, 200);
        return response()->json('errore', 500);
    }



    public function create(Request $request){
        $newindirizzo = new Indirizzo();
        $newindirizzo->indirizzable_type = $request->indirizzable_type;
        $newindirizzo->indrizzable_id = $request->indrizzable_id;
        $newindirizzo->via = $request->via;
        $newindirizzo->citta = $request->citta;
        $newindirizzo->provincia = $request->provincia;
        $newindirizzo->regione = $request->regione;

        if ($newindirizzo->save())
            return response()->json($newindirizzo, 200);
        else {
            return response()->json('errore', 500);
        }

    }

    public function update(Request $request){
        $newindirizzo = Indirizzo::find($request->id);
        $newindirizzo->indirizzable_type = $request->indirizzable_type;
        $newindirizzo->indrizzable_id = $request->indrizzable_id;
        $newindirizzo->via = $request->via;
        $newindirizzo->citta = $request->citta;
        $newindirizzo->provincia = $request->provincia;
        $newindirizzo->regione = $request->regione;

        if ($newindirizzo->save())
            return response()->json($newindirizzo, 200);
        else {
            return response()->json('errore', 500);
        }
    }

    public function delete(Request $request){
        if (Indirizzo::find($request->id)->delete())
            return response()->json('Indirizzo ' . $request->id . ' eliminato');
    }


}
