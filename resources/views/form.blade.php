@extends('layouts.app')
@section('title', isset($task) ? 'Editar tarea' : 'Crear una nueva tarea')
@section('head-title', isset($task) ? 'Editar tarea' : 'Crear una nueva tarea')
@section('content')

{{--  {{$errors}} --}}
    <form action="{{isset($task) ? route('tasks.update', ['task'=>$task]) : route('tasks.store')}}" method="post">
        @csrf
        @isset($task)
            @method('PUT')
        @endisset
        <div class="mb-4">
            <label for="title">Ingresar el titulo</label>
            <input 
                type="text" name="title" id="title" 
                value="{{$task->title ?? old('title')}}"
                @class(['border-red-500' => $errors->has('title')])>
            @error('title')
                <p class="error">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="description">Descripcion</label>
            <textarea name="description" id="description" cols="30" rows="5" 
            @class(['border-red-500' => $errors->has('description')])>{{$task->description ?? old('description')}}</textarea>
            @error('description')
                <p class="error">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="long_description">Descripcion detallada</label>
            <textarea name="long_description" id="long_description" cols="30" rows="10"
            @class(['border-red-500' => $errors->has('long_description')])>{{$task->long_description ?? old('long_description')}}</textarea>
            @error('long_description')
                <p class="error">{{$message}}</p>
            @enderror
        </div>
        <div class="flex gap-2 mb-4 items-center">
            <button class="boton" type="submit">{{isset($task) ? 'Editar' : 'Crear'}}</button>
            <a href="{{route('tasks.index')}}" class="link">Cancelar</a>
        </div>
    </form>
@endsection