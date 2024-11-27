@extends('layouts.invention')

@section('titulo', isset($student) ? 'Editar Estudiante' : 'Crear Estudiante')

@section('contenido')
<h1>{{ isset($student) ? 'Editar Estudiante' : 'Crear Estudiante' }}</h1>

<form class="formedit" action="{{ isset($student) ? route('students.update', $student) : route('students.store') }}" method="POST">
    @csrf
    @if(isset($student))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $student->name ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $student->email ?? '') }}" required>
    </div>

    <button type="submit" class="btn btn-success">{{ isset($student) ? 'Actualizar' : 'Crear' }}</button>
    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Volver a la lista</a>
</form>
@endsection
