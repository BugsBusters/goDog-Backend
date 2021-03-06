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
        $recensioni = \App\Recensione::where('recensable_id', $id )->orderBy('created_at', 'desc')->get();

        if(!is_null($recensioni))
            return response()->json($recensioni, 200);
        return response()->json('errore', 500);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     *
     * tutte le recensioni da id oggetto recensito in ordine con l'ultimo in cima
     */

    public function getByIdUtente($id){
        $recensioni = \App\Recensione::where('user_id', $id )->orderBy('created_at', 'desc')->get();

        if(!is_null($recensioni))
            return response()->json($recensioni, 200);
        return response()->json('errore', 500);
    }

}
