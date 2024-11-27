@extends('layouts.invention')

@section('titulo', 'Lista de Estudiantes')

@section('contenido')
<h1>Listado de Estudiantes</h1>  
<hr>
<div class="botones" style="
    display: flex;
    gap: 20px;
    height: 30px;">
    <a href="{{ route('students.create') }}" class="btn btn-success">NUEVO</a>
    <form style="display:flex; gap: 20px">  
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing-sm">Filtrar Nombre</span>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing-sm">Filtrar Curso</span>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
    </form>  
</div>

<table class="table table-striped">  
    <thead>  
        <tr>  
            <th class="c1">Nombre</th>  
            <th class="c2">Email</th>  
            <th class="c3">Acciones</th>  
        </tr>  
    </thead>  
    <tbody>  
        @foreach ($students as $student)  
            <tr>  
                <td class="c1">{{ $student->name }}</td>  
                <td class="c2">{{ $student->email }}</td>  
                <td class="c3">  
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">Editar</a>  
                    <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline-block;">  
                        @csrf  
                        @method('DELETE')  
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>  
                    </form>  
                </td>  
            </tr>  
        @endforeach  
    </tbody>  
</table>  
@endsection
