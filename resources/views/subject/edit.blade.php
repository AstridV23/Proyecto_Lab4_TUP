@extends('layouts.invention')

@section('titulo', isset($subject) ? 'Editar Materia' : 'Crear Materia')

@section('contenido')
<h1>{{ isset($subject) ? 'Editar Materia' : 'Crear Materia' }}</h1>

<form class="formedit" action="{{ isset($subject) ? route('subjects.update', $subject) : route('subjects.store') }}" method="POST">
    @csrf
    @if(isset($subject))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $subject->name ?? '') }}" required>
    </div>

    <button type="submit" class="btn btn-success">{{ isset($subject) ? 'Actualizar' : 'Crear' }}</button>
    <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary">Volver a la lista</a>
</form>
@endsection
