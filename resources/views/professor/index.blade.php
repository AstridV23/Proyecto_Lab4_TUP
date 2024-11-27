@extends('layouts.invention')

@section('titulo', 'Lista de Profesores')

@section('contenido')
<h1>Listado de Profesores</h1>  
<hr>
<a href="{{ route('professors.create') }}" class="btn btn-success">NUEVO</a>

<table class="table table-striped">  
    <thead>  
        <tr>  
            <th >Nombre</th>  
            <th >Comisiones</th>  
            <th class="p20">Acciones</th>  
        </tr>  
    </thead>  
    <tbody>  
        @foreach ($professors as $professor)  
            <tr>  
                <td >{{ $professor->name }}</td>  
                <td >{{ $professor->specialization }}</td>  
                <td class="p20">  
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
