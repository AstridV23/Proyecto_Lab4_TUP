@extends('layouts.invention')

@section('titulo', 'Gestión de Comisiones')

@section('contenido')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Gestión de Comisiones</h1>
        <a href="{{ route('commissions.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nueva Comisión
        </a>
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
                                <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
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
                    <a href="{{ route('commissions.index') }}" class="btn btn-secondary me-2">
                        <i class="fas fa-broom"></i> Limpiar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Buscar
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
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($commissions as $commission)
                        <tr>
                            <td>{{ $commission->course->name }}</td>
                            <td>{{ $commission->aula }}</td>
                            <td>{{ $commission->horario }}</td>
                            <td>
                                @foreach($commission->professors as $professor)
                                    {{ $professor->name }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </td>
                            <td class="text-end">
                                <a href="{{ route('commissions.edit', $commission) }}" 
                                   class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('commissions.assign-professor', $commission) }}" 
                                   class="btn btn-sm btn-info" title="Asignar Profesor">
                                    <i class="fas fa-user-plus"></i>
                                </a>
                                <form action="{{ route('commissions.destroy', $commission) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('¿Está seguro?')" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay comisiones registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($commissions->hasPages())
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    @if($commissions->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">Anterior</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $commissions->previousPageUrl() }}">Anterior</a>
                        </li>
                    @endif

                    @if($commissions->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $commissions->nextPageUrl() }}">Siguiente</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">Siguiente</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    @endif
</div>
@endsection 