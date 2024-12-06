@extends('layouts.invention')

@section('titulo', 'Gestión de Profesores')

@section('contenido')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Gestión de Profesores</h1>
        <a href="{{ route('professors.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nuevo Profesor
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Filtros de búsqueda</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('professors.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="{{ request('name') }}" placeholder="Buscar por nombre...">
                    </div>
                    <div class="col-md-6">
                        <label for="specialization" class="form-label">Especialización</label>
                        <input type="text" class="form-control" id="specialization" name="specialization" 
                               value="{{ request('specialization') }}" placeholder="Buscar por especialización...">
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('professors.index') }}" class="btn btn-light me-2">
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
                        <th>Nombre</th>
                        <th>Especialización</th>
                        <th>Comisiones</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($professors as $professor)
                        <tr>
                            <td>{{ $professor->name }}</td>
                            <td>{{ $professor->specialization }}</td>
                            <td>
                                @php
                                    $commissions = $professor->commissions->unique('course.name')->map(function($commission) {
                                        return $commission->course->name;
                                    })->implode(', ');
                                @endphp
                                {{ $commissions }}
                            </td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="{{ route('professors.show', $professor) }}" class="btn btn-info btn-sm" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('professors.edit', $professor) }}" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('professors.destroy', $professor) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" 
                                                onclick="return confirm('¿Está seguro de eliminar este profesor?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No hay profesores registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($professors->hasPages())
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    @if($professors->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">Anterior</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $professors->previousPageUrl() }}">Anterior</a>
                        </li>
                    @endif

                    @if($professors->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $professors->nextPageUrl() }}">Siguiente</a>
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