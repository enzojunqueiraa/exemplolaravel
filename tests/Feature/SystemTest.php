<?php

namespace Tests\Feature;

use App\Models\Tarefa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SystemTest extends TestCase
{
   use RefreshDatabase;

   public function test_full_tarefa_crud() {
    // criar uma tarefa
    $tarefa = Tarefa::create([
        'titulo' => 'Nova Tarefa',
        'descricao' => 'Tarefa de Teste',
        'concluida' => false
    ]);

    $this->assertDatabaseHas('tarefas', [
        'titulo' => 'Nova Tarefa',
      
    ]);
    //assertDatabaseHas: Este método verifica se há uma entrada específica no banco de dados.

    //Read
    $tarefaRecuperada = Tarefa::find($tarefa->id);
    $this->assertEquals('Nova Tarefa', $tarefaRecuperada->titulo);
    $this->assertEquals('Tarefa de Teste', $tarefaRecuperada->descricao);

    //Update
    $tarefaRecuperada->update(['titulo' => 'Tarefa Atualizada']);
    $this->assertEquals('Tarefa Atualizada', $tarefaRecuperada->titulo);
    
    //Delte
    $tarefaRecuperada->delete();
    $this->assertDatabaseMissing('tarefas', ['id'=> $tarefaRecuperada->id]);
    //assertDatabaseMissing: Este método verifica se não mais um determinado registo no banco de dados

   }
}
