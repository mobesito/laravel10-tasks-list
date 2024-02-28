<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use \App\Http\Requests\TaskRequest;
use \App\Models\Task;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//ruta para el index [GET]
/* Route::get('/tasks', function() {
    return view('index', [
        'tasks' => Task::latest()->get()
        //'tasks' => \App\Models\Task::latest()->where('completed', true)->get()
    ]);
})->name('tasks.index'); */


Route::view('/tasks', 'index', [

    //'tasks' => Task::latest()->get()
    'tasks' => Task::latest()->paginate(10  )
])->name('tasks.index');

//ROUTING PARA FORMULARIO DE CREACION DE TAREA
Route::view('/tasks/create', 'create')
->name('tasks.create');


//route para formulario de creacion [POST]
Route::post('/tasks', function(TaskRequest $request){
    //Task::create() recibe un array con las propiedades y sus valores
    //como $request->validated() retorna un array, solo hay q ponerlo adentro.

    //ademas para que el create funcione hay que llenar una variable $fillable
    //en el modelo, sino dara error...
    $task = Task::create($request->validated());
    return redirect()->route('tasks.show', ['task' => $task->id])
    ->with('success', 'Tarea creada con éxito!');

})->name('tasks.store');


/* 
 CREATE TASK - OLD WAY
Route::post('/tasks', function(Request $request){
  $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
  ]);
    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();
    return redirect()->route('tasks.show', ['id' => $task->id])
    ->with('success', 'Tarea creada con éxito!');

})->name('tasks.store'); */


//route para modificar una tarea [PUT]
Route::put('/tasks/{task}', function(Task $task, TaskRequest $request){
   
    //update tambien recibe un array, tambien necesita la variable 
    //$fillable configurada en el modelo antes de utilizarlo...
    $task->update($request->validated());
    return redirect()->route('tasks.show', ['task' => $task->id])
    ->with('success', 'Tarea modificada con éxito!');

})->name('tasks.update');

//UPDATE TASK - OLD WAY
/* Route::put('/tasks/{id}', function ($id, Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    $task = Task::findOrFail($id);
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();

    return redirect()->route('tasks.show', ['id' => $task->id])->with('success', 'Task updated successfully!');
})->name('tasks.update'); */


//route para formulario de edicion [GET]
Route::get('/tasks/{task}/edit', function(Task $task){

        return view('edit', [
            //'task' => \App\Models\Task::find($id)
            'task' => $task
        ]);
        
})->name('tasks.edit');

//ROUTE TO EDIT FORM - OLD WAY
/* 
Route::get('/tasks/{id}/edit', function($id){

    return view('edit', [
        //'task' => \App\Models\Task::find($id)
        //this is called (fetch data)
        'task' => Task::findOrFail($id)
    ]);
    
})->name('tasks.edit'); */

//ruta para una pagina con la informacion de una tarea [GET]
Route::get('/tasks/{task}', function(Task $task){

        return view('show', [
            //'task' => \App\Models\Task::find($id)
            'task' => $task
        ]);

})->name('tasks.show');

/* 
TASK INFORMATION ROUTE - OLD WAY
Route::get('/tasks/{id}', function($id){

    return view('show', [
        //'task' => \App\Models\Task::find($id)
        'task' => Task::findOrFail($id)
    ]);

})->name('tasks.show'); */

//si la ruta al ingresar la url es desconocia llamar a la ruta del index.
Route::fallback(function(){
    return redirect()->route('tasks.index');
});

Route::delete('/tasks/{task}', function(Task $task){
    $task->delete();
    return redirect()->route('tasks.index')->with('success','Tarea eliminada con éxito!');
})->name('tasks.destroy');

//ROUTE PARA CAMBIAR ESTADO COMPLETADO/NO COMPLETADO
Route::put('/tasks/{task}/task-toggle', function(Task $task){
    $task->toggleTask();
    return redirect()->back()->with('success', 'Tarea actualizada correctamente!');
})->name('tasks.toggle-complete');



//-----------------------------------------------------
//------------ INTRODUCCIÓN ---------------------------


/* 
Route::get('/xxx', function (){
    return 'Hello';
})->name('hello'); */

//USING PARAMETERS TO HAVE DYNAMIC PAGES/urls 
/* Route::get('/greet/{name}', function($name){
    return 'Hello ' . $name . '!';
}); */

//---- OLD URL TO A NEW ONE ----------
/* Route::get('/hallo', function(){
    return redirect()->route('hello');
}); */

//------ PAGINA POR DEFECTO SI LA URL NO ES ENCONTRADA -----------
/* Route::fallback(function(){
    return redirect()->route('index');
}); */

//get

//------DANGEROUS-----------
//post
//put
//delete
