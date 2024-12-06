@extends('layouts.invention')

@section('titulo', 'Editar Curso')

@section('contenido')
<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Editar Curso</h5>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('courses.update', $course) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Curso</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $course->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="subject_id" class="form-label">Materia</label>
                    <select class="form-select @error('subject_id') is-invalid @enderror" 
                            id="subject_id" name="subject_id" required>
                        <option value="">Seleccionar materia</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" 
                                {{ (old('subject_id', $course->subject_id) == $subject->id) ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('subject_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Estudiantes Asignados</label>
                    <div class="card">
                        <div class="card-body" style="max-height: 200px; overflow-y: auto;">
                            @foreach($students as $student)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           name="students[]" value="{{ $student->id }}" 
                                           id="student{{ $student->id }}"
                                           {{ in_array($student->id, $currentStudents) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="student{{ $student->id }}">
                                        {{ $student->name }} ({{ $student->email }})
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Actualizar Curso</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
