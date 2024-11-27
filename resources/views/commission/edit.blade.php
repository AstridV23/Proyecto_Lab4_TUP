@extends('layouts.invention')

@section('titulo', isset($commission) ? 'Editar Comision' : 'Crear Comision')

@section('contenido')
<h1>{{ isset($commission) ? 'Editar Comision' : 'Crear Comision' }}</h1>

<form class="formedit" action="{{ isset($commission) ? route('commissions.update', $commission) : route('commissions.store') }}" method="POST">
    @csrf
    @if(isset($commission))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="aula">Aula</label>
        <input type="text" name="aula" class="form-control" value="{{ old('aula', $commission->aula ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="horario">Horario</label>
        <input type="text" name="horario" class="form-control" value="{{ old('horario', $commission->horario ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="course_id">Curso ID</label>
        <input type="text" name="course_id" class="form-control" value="{{ old('course_id', $commission->course_id ?? '') }}" required>
    </div>

    <button type="submit" class="btn btn-success">{{ isset($commission) ? 'Actualizar' : 'Crear' }}</button>
    <a href="{{ route('commissions.index') }}" class="btn btn-outline-secondary">Volver a la lista</a>

</form>
@endsection
