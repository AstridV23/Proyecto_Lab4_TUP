@extends('layouts.invention')

@section('titulo', 'Crear Nuevo Curso')

@section('contenido')
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Crear Nuevo Curso</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('courses.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Curso</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="subject_id" class="form-label">Materia</label>
                    <select class="form-select @error('subject_id') is-invalid @enderror" 
                            id="subject_id" name="subject_id" required>
                        <option value="">Seleccione una materia</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" 
                                    {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('subject_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Crear Curso</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
