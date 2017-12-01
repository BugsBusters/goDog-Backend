<?php

namespace Tests\Feature;

use App\Inserzione;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\User;

class InserzioneTest extends TestCase
{

    public function testinserzioni()
    {
        $this->withoutMiddleware();
        $this->json('GET','/api/inserzioni')->assertStatus(200);
    }

    public function testinserzione()
    {
        $this->withoutMiddleware();
        $inserzioneid = Inserzione::all()->last()->id;
        $this->json('GET', '/api/inserzione/'.$inserzioneid)->assertStatus(200);
    }

    public function testinserzionebytipo()
    {
        $this->withoutMiddleware();
        $tipo = Inserzione::all()->last()->tipoinserzione;
        $this->json('GET', '/api/inserzioni/'.$tipo)->assertStatus(200);
    }

    public function testinserzionebyuser()
    {
        $this->withoutMiddleware();
        $user = User::all()->last()->id;
        $this->json('GET', '/api/inserzioni-user/'.$user)->assertStatus(200);
    }

    public function testinseriscinserzione()
    {
        $id=Inserzione::all()->first()->id;
        $this->withoutMiddleware();
        $this->json('POST', '/api/inserisci-inserzione/',[
            'contenuto' => 'Scontenuto',
            'tipoinserzione' => 'Stipoinserzione',
            'fotopath' => 'Sfotopath',
            'user_id' => $id+1
        ])->assertStatus(200);
    }

    public function testmodificainserzione()
    {
        $id=Inserzione::all()->last()->id;
        $this->withoutMiddleware();
        $this->json('POST', '/api/modifica-inserzione/',[
            'contenuto' => 'Scontenuto',
            'tipoinserzione' => 'Stipoinserzione',
            'fotopath' => 'Sfotopattto',
            'user_id' => '1',
            'id'=>$id
        ])->assertStatus(200);
    }


    public function testeliminainserzione()
    {
        $id=Inserzione::all()->first()->id;
        $this->withoutMiddleware();
        $this->json('POST', '/api/elimina-inserzione/',[
            'id'=>$id
        ])->assertStatus(200);
    }



}
