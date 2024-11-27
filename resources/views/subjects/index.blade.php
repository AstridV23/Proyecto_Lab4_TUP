@extends('layouts.invention')

@section('titulo', 'Gestión de Materias')

@section('contenido')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Gestión de Materias</h1>
        <a href="#" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nueva Materia
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Filtros de búsqueda</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('subjects.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="{{ request('name') }}" placeholder="Buscar por nombre...">
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('subjects.index') }}" class="btn btn-light me-2">
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
                        <th>Cursos Asociados</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subjects as $subject)
                        <tr>
                            <td>{{ $subject->name }}</td>
                            <td>
                                @foreach($subject->courses as $course)
                                    {{ $course->name }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </td>
                            <td class="text-end">
                                <a href="#" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="#" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('¿Está seguro de eliminar esta materia?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No hay materias registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($subjects->hasPages())
            <div class="card-footer">
                {{ $subjects->links() }}
            </div>
        @endif
    </div>
</div>
@endsection 