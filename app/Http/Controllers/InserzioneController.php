<?php

namespace App\Http\Controllers;

use App\Inserzione;
use App\Indirizzo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Recensione;

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
        if(count($inserzione)==0)
            return response()->json('nessuna inserzione con id:'.$request->id, 500);
        $app = json_decode($inserzione, true);

        $app['updated_at']=$inserzione->updated_at->format('d-m-Y H:m:s');

        return response()->json($app,200);
    }

    public function inserzionebytipo($tipo) {
        $inserzione = Inserzione::where('tipoinserzione', $tipo)->get();

        if(count($inserzione)==0)
            return response()->json('nessuna inserzione di questo tipo:'.$tipo, 500);

        if (count($inserzione)>0)
            return response()->json($inserzione, 200);
        return response()->json('errore', 500);
    }

    public function inserzionibyuser($user) {
        $inserzione = Inserzione::where('user_id', $user)->get();

        if(count($inserzione)==0)
            return response()->json('nessuna inserzione di questo user:'.$user, 500);

        if (count($inserzione)>0)
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
        $inserzione->contenuto=$request->contenuto;
        $inserzione->tipoinserzione=$request->tipoinserzione;
        $inserzione->fotopath=$request->fotopath;
        $inserzione->user_id=$request->user_id;

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

        if(count($inserzione)==0)
            return response()->json('nessuna inserzione con id:'.$request->id, 500);

        $inserzione->updated_at=Carbon::now(2)->toDateTimeString();
        $inserzione->contenuto=$request->contenuto;
        $inserzione->tipoinserzione=$request->tipoinserzione;
        $inserzione->fotopath=$request->fotopath;
        $inserzione->user_id=$request->user_id;

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
        if(count($inserzione)==0)
            return response()->json('nessuna inserzione con id:'.$request->id, 500);

        if ($inserzione->delete())
            return response()->json($inserzione, 200);
        return response()->json('errore', 500);
    }

    public function rateById($id){
        $recensioni = \App\Recensione::where('recensable_type', 'App\Inserzione')->where('recensable_id', $id )->avg('rate');
        if (!is_null($recensioni))
            return response()->json($recensioni, 200);
        return response()->json('0', 200);
    }



    public function lookup(Request $request){
        $data = $request->toArray();
        $categoria = $data['tipo'];
        $geoids = array();
        if (array_key_exists('citta',$data)) {
            //$data['indirizzable_type'] = 'App\Inserzione';
            $comune = Comune::select('id')->where('nome', $data['citta'])->first()->toArray();

            $geoids['citta'] = $comune['id'];

        }
        if (array_key_exists('provincia',$data)) {
            //$data['indirizzable_type'] = 'App\Inserzione';
            $provincia = Provincia::select('id')->where('nome', $data['provincia'])->first()->toArray();
            $geoids['provincia'] = $provincia['id'];

        }
        if (array_key_exists('regione',$data)) {
            //$data['indirizzable_type'] = 'App\Inserzione';
            $provincia = Regione::select('id')->where('nome', $data['regione'])->first()->toArray();
            $geoids['regione'] = $provincia['id'];

        }
        $geoids['indirizzable_type'] = 'App\Inserzione';
        $indirizzi = Indirizzo::where($geoids)->get();

        $inserzioni = array();
        foreach ($indirizzi as $indirizzo) {
            $inserzione = Inserzione::find($indirizzo->indrizzable_id);
            array_push($inserzioni, $inserzione);
        }

        if(!empty($inserzioni))
            return response()->json($inserzioni, 200);
        return response()->json('errore', 500);
    }
    
    
    public function trovaCaniSmarriti(){
        return response()->json(Inserzione::where('tipoinserzione_id','amico')->get(),200);
        }
    
    public function trovaCaniSmarritiById($id){
        return response()->json(Inserzione::find($id),200);
    }
}
