@extends('layouts.invention')

@section('titulo', 'Crear Nuevo Profesor')

@section('contenido')
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Crear Nuevo Profesor</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('professors.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Profesor</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="specialization" class="form-label">Especialización</label>
                    <input type="text" class="form-control @error('specialization') is-invalid @enderror" 
                           id="specialization" name="specialization" value="{{ old('specialization') }}" required>
                    @error('specialization')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('professors.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Crear Profesor</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
