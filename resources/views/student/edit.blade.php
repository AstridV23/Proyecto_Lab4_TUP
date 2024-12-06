@extends('layouts.invention')

@section('titulo', isset($student) ? 'Editar Estudiante' : 'Nuevo Estudiante')

@section('contenido')
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">{{ isset($student) ? 'Editar' : 'Crear' }} Estudiante</h5>
        </div>
        <div class="card-body">
            <form action="{{ isset($student) ? route('students.update', $student) : route('students.store') }}" method="POST">
                @csrf
                @if(isset($student))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $student->name ?? '') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email', $student->email ?? '') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="course_id" class="form-label">Curso</label>
                    <select name="course_id" id="course_id" class="form-select @error('course_id') is-invalid @enderror">
                        <option value="">Seleccione un curso</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" 
                                {{ (old('course_id', $currentCourseId ?? null) == $course->id) ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('course_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('students.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        {{ isset($student) ? 'Actualizar' : 'Crear' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

