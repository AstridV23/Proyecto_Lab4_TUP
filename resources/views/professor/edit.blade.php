@extends('layouts.invention')

@section('titulo', isset($professor) ? 'Editar Profesor' : 'Crear Profesor')

@section('contenido')
<h1>{{ isset($professor) ? 'Editar Profesor' : 'Crear Profesor' }}</h1>

<form class="formedit" action="{{ isset($professor) ? route('professors.update', $professor) : route('professors.store') }}" method="POST">
    @csrf
    @if(isset($professor))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $professor->name ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="specialization">Especializacion</label>
        <input type="text" name="specialization" class="form-control" value="{{ old('specialization', $professor->specialization ?? '') }}" required>
    </div>

    <button type="submit" class="btn btn-success">{{ isset($professor) ? 'Actualizar' : 'Crear' }}</button>
    <a href="{{ route('professors.index') }}" class="btn btn-outline-secondary">Volver a la lista</a>

</form>
@endsection
