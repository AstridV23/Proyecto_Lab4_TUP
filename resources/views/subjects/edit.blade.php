@extends('layouts.invention')

@section('titulo', 'Editar Materia')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Editar Materia</h5>
                    <a href="{{ route('subjects.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('subjects.update', $subject) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre de la Materia</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $subject->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="courses" class="form-label">Cursos Asociados</label>
                            <div class="card p-3">
                                <div id="courseContainer">
                                    @foreach($subject->courses as $course)
                                        <div class="course-entry mb-2">
                                            <div class="input-group">
                                                <input type="text" name="courses[]" class="form-control" 
                                                       value="{{ $course->name }}" required>
                                                <button type="button" class="btn btn-danger remove-course">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="course-entry mb-2">
                                        <div class="input-group">
                                            <input type="text" name="courses[]" class="form-control" 
                                                   placeholder="Nuevo curso">
                                            <button type="button" class="btn btn-success add-course">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted">Puedes agregar, editar o eliminar cursos de esta materia</small>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Actualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const courseContainer = document.getElementById('courseContainer');
    
    // Agregar curso
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('add-course') || 
            e.target.parentElement.classList.contains('add-course')) {
            const newEntry = document.createElement('div');
            newEntry.className = 'course-entry mb-2';
            newEntry.innerHTML = `
                <div class="input-group">
                    <input type="text" name="courses[]" class="form-control" 
                           placeholder="Nombre del curso" required>
                    <button type="button" class="btn btn-danger remove-course">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            `;
            e.target.closest('.course-entry').before(newEntry);
        }
        
        // Eliminar curso
        if (e.target.classList.contains('remove-course') || 
            e.target.parentElement.classList.contains('remove-course')) {
            if (document.querySelectorAll('.course-entry').length > 1) {
                e.target.closest('.course-entry').remove();
            }
        }
    });
});
</script>
@endsection
