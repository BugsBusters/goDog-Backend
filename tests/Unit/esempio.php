<?php
namespace Tests\Unit;
use App\Model\Appezzamento;
use App\Model\Uliveto;
use Tests\TestCase;
class AppezzamentoTest extends TestCase
{
/
* Chiamo la route e testo che ritorni lo status 200
*/
    public function testGetAppezzamenti()
    {
        $this->json('GET', '/api/appezzamenti')->assertStatus(200);
    }
/
* Chiamo la route e testo che ritorni lo status 200
*/
    public function testGetAppezzamentiByUliveto()
    {
        $uliveto_id = Uliveto::all()->last()->id;
        $this->json('GET', '/api/appezzamenti/',[$uliveto_id])->assertStatus(200);
    }
/
* verifico che restituisca un appezzamento (Status 200)
*/
    public function testgetAppezzamentoById()
    {
        $uliveto_id = Uliveto::all()->last()->id;
        $this->json('GET', '/api/appezzamenti/',[$uliveto_id])->assertStatus(200);
    }
/
* Testo la route di inserimento appezzamento e verifico che torni lo status 201 (created)
*/
    public function testInserisciAppezzamento(){
        $uliveto_id = Uliveto::all()->last()->id;
        $this->json('POST', '/api/appezzamento', [
            'uliveto_id' => $uliveto_id,
            'nome' => 'Appezzamento di prova',
            'note' => 'Note',
            'mappa' => 'mappa'
        ])->assertStatus(201);
    }
/
* Testo la route di modifica e verifico che torni lo status 200
*/
    public function testAggiornaAppezzamento(){
        $this->json('POST', '/api/aggiorna-appezzamento', [
            'id' => Appezzamento::all()->last()->id,
            'uliveto_id' => Uliveto::all()->last()->id,
            'nome' => 'SAppezzamento di prova',
            'note' => 'SNote',
            'mappa' => 'Smappa'
        ])->assertStatus(200);
    }
/
*  Testo la route di eliminazione e verifico che torni lo status 200
*/
    public function testEliminaAppezzamento(){
        $this->json('POST', '/api/elimina-appezzamento', [
            'id' => Appezzamento::all()->last()->id,
        ])->assertStatus(200);
    }
}