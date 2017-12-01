<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class Recensione extends TestCase
{


    public function testallRec(){
        $this->withoutMiddleware();
        $this->json('GET','/api/recensioni')->assertStatus(200);
    }
}
