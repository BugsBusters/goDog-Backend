<?php

namespace Tests\Unit;

use App\Recensione;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class RecensioneTest extends TestCase
{


    public function testallRec(){
        $this->withoutMiddleware();
        $this->json('GET','/api/recensioni')->assertStatus(200);
    }


    public function testgetById(){

        $recensione_id = Recensione::all()->last()->id;
        $this->json('GET', '/api/recensione',[$recensione_id])->assertStatus(200);
    }

    public function testnewRec(){
        $this->json('POST', '/api/modifica-recensione', [
            'id' => Recensione::all()->last()->id,
            'recensable_id' => '1',
            'recensable_type' => 'Prova',
            'rate' => '1',
            'commento' => 'provaprovaprova',
            'user_id' => User::all()->last()->id,
        ])->assertStatus(200);
    }

    public function testmodificaRecensione(){
        $this->json('POST', '/api/modifica-recensione', [
            'id' => Recensione::all()->last()->id,
            'recensable_id' => '11',
            'recensable_type' => '1Prova',
            'rate' => '2',
            'commento' => '1provaprovaprova',
            'user_id' => User::all()->last()->id,
        ])->assertStatus(200);
    }

    public function testeliminaRecensione(){
        $this->json('POST', '/api/elimina-recensione', [
            'id' => Recensione::all()->last()->id,
        ])->assertStatus(200);
    }

    public function testgetByIdRecensable(){
        $recensito_id = Recensione::all()->last()->id;
        $this->json('GET', '/api/recensioni/inserzione',[$recensito_id])->assertStatus(200);
    }

    public function testgetByIdUtente(){
        $recensito_id = Recensione::all()->last()->id;
        $this->json('GET', '/api/recensioni/utente',[$recensito_id])->assertStatus(200);
    }
}