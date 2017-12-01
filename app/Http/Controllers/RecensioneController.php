<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;

use App\Recensione;

class RecensioneController extends Controller
{
    public function allRec(){

        $tutteRecensioni = Recensione::all();


        if(!is_null($tutteRecensioni))
            return response()->json($tutteRecensioni, 200);

        return response()->json('nessuna recensione', 500);
    }

    public function getById(Request $request){

        $recById = Recensione::find($request->id);
        return response()->json($recById , 200);
    }


    public function newRec(Request $request){

        $newrecensione= new Recensione();

        $newrecensione->id = $request->id;
        $newrecensione->recensable_id = $request->recensable_id;
        $newrecensione->recensable_type= $request->recensable_type;
        $newrecensione->rate= $request->rate;
        $newrecensione->commento= $request->commento;
        $newrecensione->user_id= $request->user_id;

/**
        // da italiano a americano
        $anno_1 = substr( $request->created_at, 6, 4);
        $mese_1 = substr( $request->created_at, 3,2);
        $giorno_1 = substr( $request->created_at, 0,2);
        $newrecensione->created_1 = $anno_1 . '-' . $mese_1 . '-' . $giorno_1;

        // da italiano a americano
        $anno_2 = substr( $request->updated_at, 6, 4);
        $mese_2 = substr( $request->updated_at, 3,2);
        $giorno_2 = substr( $request->updated_at, 0,2);
        $newrecensione->created_2 = $anno_2 . '-' . $mese_2 . '-' . $giorno_2;
**/

        if($newrecensione->save())
            return response()->json($newrecensione, 200);

        return response()->json('errore', 500);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     *
     */
    public function modificaRecensione(Request $request){

        $newrecensione = Recensione::find($request->id);


        $newrecensione->recensable_id = $request->recensable_id;
        $newrecensione->recensable_type= $request->recensable_type;
        $newrecensione->rate= $request->rate;
        $newrecensione->commento= $request->commento;
        $newrecensione->updated_at=Carbon::now(2)->toDateTimeString();
        $newrecensione->user_id= $request->user_id;

        if($newrecensione->save())
            return response()->json($newrecensione, 200);
        return response()->json('errore', 500);


    }

    public function eliminaRecensione(Request $request){
        $recensione = Recensione::find($request->id);

        if ($recensione->delete())
            return response()->json($recensione, 200);
        return response()->json('errore', 500);
    }


    public function getByIdRecensable($id){
        $recensioni = \App\Recensione::where('recensable_id', $id )->get();

        if(!is_null($recensioni))
            return response()->json($recensioni, 200);
        return response()->json('errore', 500);

    }

public function getByIdUtente($id){
    $recensioni = \App\Recensione::where('user_id', $id )->get();

    if(!is_null($recensioni))
        return response()->json($recensioni, 200);
    return response()->json('errore', 500);
}
}
