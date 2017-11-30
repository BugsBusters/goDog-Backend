<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Recensione extends TestCase
{


    public function testallRec(){
        $this->json('GET','/api/recensioni')->assertStatus(200);
    }
}
