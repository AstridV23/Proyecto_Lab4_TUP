@extends('layouts.invention')

@section('titulo', 'Detalles del Estudiante')

@section('contenido')
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Información del Estudiante</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <p class="form-control-static">{{ $student->name }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <p class="form-control-static">{{ $student->email }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Curso</label>
                <p class="form-control-static">{{ $student->course->name ?? 'Sin curso asignado' }}</p>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('students.index') }}" class="btn btn-secondary me-2">Volver</a>
                <a href="{{ route('students.edit', $student) }}" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
</div>
@endsection
