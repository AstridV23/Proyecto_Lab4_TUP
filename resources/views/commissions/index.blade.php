@extends('layouts.invention')

@section('titulo', 'Gestión de Comisiones')

@section('contenido')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Gestión de Comisiones</h1>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Filtros de búsqueda</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('commissions.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="course_id" class="form-label">Curso</label>
                        <select class="form-select" id="course_id" name="course_id">
                            <option value="">Todos los cursos</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" 
                                        {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="horario" class="form-label">Horario</label>
                        <input type="text" class="form-control" id="horario" name="horario" 
                               value="{{ request('horario') }}" placeholder="Buscar por horario...">
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('commissions.index') }}" class="btn btn-light me-2">
                        <i class="fas fa-undo me-1"></i>Limpiar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-1"></i>Buscar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Curso</th>
                        <th>Aula</th>
                        <th>Horario</th>
                        <th>Profesores</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($commissions as $commission)
                        <tr>
                            <td>{{ $commission->course->name }}</td>
                            <td>{{ $commission->aula }}</td>
                            <td>{{ $commission->horario }}</td>
                            <td>
                                @foreach($commission->professors as $professor)
                                    {{ $professor->name }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No hay comisiones registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($commissions->hasPages())
            <div class="card-footer">
                {{ $commissions->links() }}
            </div>
        @endif
    </div>
</div>
@endsection 