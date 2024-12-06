@extends('layouts.invention')

@section('titulo', 'Editar Comisión')

@section('contenido')
<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Editar Comisión</h5>
            <a href="{{ route('commissions.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('commissions.update', $commission) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="course_id" class="form-label">Curso</label>
                    <select class="form-select @error('course_id') is-invalid @enderror" 
                            id="course_id" name="course_id" required>
                        <option value="">Seleccionar curso</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" 
                                    {{ (old('course_id', $commission->course_id) == $course->id) ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('course_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="aula" class="form-label">Aula</label>
                    <input type="text" class="form-control @error('aula') is-invalid @enderror" 
                           id="aula" name="aula" value="{{ old('aula', $commission->aula) }}" required>
                    @error('aula')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="horario" class="form-label">Horario</label>
                    <input type="text" class="form-control @error('horario') is-invalid @enderror" 
                           id="horario" name="horario" 
                           value="{{ old('horario', $commission->horario) }}" required>
                    @error('horario')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar Comisión
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection