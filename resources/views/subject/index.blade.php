@extends('layouts.invention')

@section('titulo', 'Lista de Materias')

@section('contenido')
<h1>Listado de Materias</h1>  
<hr>
    <a href="{{ route('subjects.create') }}" class="btn btn-success">NUEVO</a> 

<table class="table table-striped">  
    <thead>  
        <tr>  
            <th >Nombre</th>  
            <th class="p25">Acciones</th>  
        </tr>  
    </thead>  
    <tbody>  
        @foreach ($subjects as $subject)  
            <tr>  
                <td>{{ $subject->name }}</td>  
                <td class="p25">  
                    <a href="{{ route('students.edit', $subject) }}" class="btn btn-info">Ver</a>  
                    <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-warning">Editar</a>  
                    <form action="{{ route('subjects.destroy', $subject) }}" method="POST" style="display:inline-block;">  
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
