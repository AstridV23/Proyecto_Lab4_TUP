@extends('layouts.invention')

@section('titulo', 'Lista de Profesores')

@section('contenido')
<h1>Listado de Profesores</h1>  
<hr>
<a href="{{ route('professors.create') }}" class="btn btn-success">Agregar Profesor</a>

<table class="table table-striped">  
    <thead>  
        <tr>  
            <th class="c1">Nombre</th>  
            <th class="c2">Especializacion</th>  
            <th class="c3">Acciones</th>  
        </tr>  
    </thead>  
    <tbody>  
        @foreach ($professors as $professor)  
            <tr>  
                <td class="c1">{{ $professor->name }}</td>  
                <td class="c2">{{ $professor->specialization }}</td>  
                <td class="c2">  
                    <a href="{{ route('professors.edit', $professor) }}" class="btn btn-warning">Editar</a>  
                    <form action="{{ route('professors.destroy', $professor) }}" method="POST" style="display:inline-block;">  
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
