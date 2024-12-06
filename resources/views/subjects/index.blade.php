@extends('layouts.invention')

@section('titulo', 'Gestión de Materias')

@section('contenido')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Materias</h1>
        <a href="{{ route('subjects.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nueva Materia
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Filtros de búsqueda</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('subjects.index') }}">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="{{ request('name') }}" placeholder="Buscar por nombre...">
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">
                            <i class="fas fa-broom"></i> Limpiar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
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
                                    <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('subjects.destroy', $subject) }}" method="POST" 
                                          class="d-inline" onsubmit="return confirm('¿Estás seguro?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
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
        </div>
    </div>

    @if($subjects->hasPages())
        <div class="mt-4">
            {{ $subjects->links() }}
        </div>
    @endif
</div>
@endsection 