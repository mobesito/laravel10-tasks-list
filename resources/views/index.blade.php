@extends('layouts.app')

@section('title', 'Listado de tareas')
@section('head-title', 'Inicio')

@section('content')
    <div class="mb-4">
        <a href="{{route('tasks.create')}}" class="link">Crear Tarea ➕</a>
    </div>
    @forelse ($tasks as $task)
        <div>
        <a href="{{route('tasks.show', ['task' => $task] )}}" 
            @class(['line-through' => $task->completed])>{{ $task->title }}</a> 
    </div>
    @empty
        <div>No hay tareas...</div>
    @endforelse
    @if ($tasks->count())
        <nav class="mt-4">
            {{$tasks->links()}}
        </nav>
    @endif
@endsection