@extends('layouts.invention')

@section('titulo', isset($course) ? 'Editar Curso' : 'Crear Curso')

@section('contenido')
<h1>{{ isset($course) ? 'Editar Curso' : 'Crear Curso' }}</h1>

<form class="formedit" action="{{ isset($course) ? route('courses.update', $course) : route('courses.store') }}" method="POST">
    @csrf
    @if(isset($course))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $course->name ?? '') }}" required>
    </div>

    <button type="submit" class="btn btn-success">{{ isset($course) ? 'Actualizar' : 'Crear' }}</button>
    <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">Volver a la lista</a>
</form>
@endsection
