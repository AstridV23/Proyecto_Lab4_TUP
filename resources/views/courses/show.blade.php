@extends('layouts.invention')

@section('titulo', 'Detalles del Curso')

@section('contenido')
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Información del Curso</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Nombre del Curso</label>
                <p class="form-control-static">{{ $course->name }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Materia</label>
                <p class="form-control-static">{{ $course->subject->name }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Estudiantes Inscritos</label>
                @if($course->students->count() > 0)
                    <ul class="list-group">
                        @foreach($course->students as $student)
                            <li class="list-group-item">
                                {{ $student->name }} ({{ $student->email }})
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No hay estudiantes inscritos</p>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Comisiones</label>
                @if($course->commissions->count() > 0)
                    <ul class="list-group">
                        @foreach($course->commissions as $commission)
                            <li class="list-group-item">
                                Aula: {{ $commission->aula }} - 
                                Horario: {{ $commission->horario }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No hay comisiones asignadas</p>
                @endif
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('courses.index') }}" class="btn btn-secondary me-2">Volver</a>
                <a href="{{ route('courses.edit', $course) }}" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
</div>
@endsection
