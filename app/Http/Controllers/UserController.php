<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Indirizzo;

class UserController extends Controller
{
    public function getall(){
        $users = \App\User::all();

        foreach ($users as $user) {
            $anno = substr( $user->datanascita, 0, 4);
            $mese = substr( $user->datanascita, 5,2);
            $giorno = substr( $user->datanascita, 8,2);
            $user->datanascita = $giorno . '-' . $mese . '-' . $anno;
        }
        if (!is_null($users))
            return response()->json($users->toArray(), 200);
        return response()->json('errore', 500);
    }

    public function getById($id) {
        $users = \App\User::find($id);

        $anno = substr( $users->datanascita, 0, 4);
        $mese = substr( $users->datanascita, 5,2);
        $giorno = substr( $users->datanascita, 8,2);
        $users->datanascita = $giorno . '-' . $mese . '-' . $anno;

        if (!is_null($users))
            return response()->json($users->toArray(), 200);
        return response()->json('errore', 500);
    }

    public function create(Request $request){
        $newuser = new User();
        $newuser->name = $request->name;
        $newuser->password = Hash::make($request->password);
        $newuser->email = $request->email;
        $newuser->cognome = $request->cognome;
        $newuser->fotopath = $request->fotopath;

        $anno = substr( $request->datanascita, 6, 4);
        $mese = substr( $request->datanascita, 3,2);
        $giorno = substr( $request->datanascita, 0,2);
        $newuser->datanascita = $anno . '-' . $mese . '-' . $giorno;
        $newuser->plan = $request->plan;
        $newuser->save();

        $newindirizzo = new Indirizzo();
        $newindirizzo->via = $request->via;
        $newindirizzo->citta = $request->citta;
        $newindirizzo->regione = $request->regione;
        $newindirizzo->provincia = $request->provincia;

        $newindirizzo->indirizzable_type = 'App\User';
        $newindirizzo->indrizzable_id = $newuser->id;


        if ($newuser->save() && $newindirizzo->save())
            return response()->json([$newuser->toArray(), $newindirizzo->toArray()], 200);
        else {
            $newuser->delete();
            $newindirizzo->delete();
            return response()->json('errore', 500);
        }

    }

    public function update(Request $request){
        $newuser = User::find($request->id);
        $newuser->name = $request->name;
        $newuser->password = Hash::make($request->password);
        $newuser->email = $request->email;
        $newuser->cognome = $request->cognome;
        $newuser->fotopath = $request->fotopath;

        $anno = substr( $request->datanascita, 6, 4);
        $mese = substr( $request->datanascita, 3,2);
        $giorno = substr( $request->datanascita, 0,2);
        $newuser->datanascita = $anno . '-' . $mese . '-' . $giorno;
        $newuser->plan = $request->plan;


        if ($newuser->save())
            return response()->json($newuser->toArray(), 200);
        return response()->json('errore', 500);
    }

    public function delete(Request $request){
        if (User::find($request->id)->delete())
            return response()->json('Utente ' . $request->id . ' eliminato');
    }

    public function getindirizzo($id){
       // $indirizzo = Indirizzo::where([, 'indirizzable_type'], [$id, 'App\User']);
        $indirizzo = \App\Indirizzo::where('indrizzable_id', $id)->where('indirizzable_type', 'App\User')->get();



        if(!is_null($indirizzo))
            return response()->json($indirizzo, 200);
        return response()->json('Errore', 500);
    }
}
