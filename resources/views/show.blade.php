@extends('layouts.app')

@section('title', $task->title)
@section('head-title', $task->title)
@section('content')

    <div class="mb-4">
        <a href="{{route('tasks.index')}}" class="link">↩ Regresar</a>
    </div>

    <p class="mb-4 text-slate-700">{{$task->description}}</p>

    @if($task->long_description)
        <p class="mb-4 text-slate-700">{{$task->long_description}}</p>
    @endif
    <p class="mb-4 text-sm text-slate-500">Creado {{$task->created_at->diffForHumans()}} ▪ Actualizado {{$task->updated_at->diffForHumans()}}</p>

    <div class="mb-4">
        @if ($task->completed)
            <nav class="font-medium text-green-500">Completada</nav>
        @else
            <nav class="font-medium text-red-500">No Completada</nav>
        @endif
    </div>

    <div class="flex gap-2">
        <a href="{{route('tasks.edit', ['task' => $task])}}" 
            class="boton">Editar</a>

        <form action="{{route('tasks.toggle-complete', ['task' => $task])}}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit" class="boton">
                Marcar como {{$task->completed ? 'no completada' : 'completada'}}
            </button>
        </form>
        <form action="{{route('tasks.destroy', ['task' => $task])}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="boton">Eliminar</button>
        </form>
    </div>
@endsection