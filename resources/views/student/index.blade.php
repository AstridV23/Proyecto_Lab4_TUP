@extends('layouts.invention')

@section('titulo', 'Lista de Estudiantes')

@section('contenido')
<h1>Listado de Estudiantes</h1>  
<hr>
<a href="{{ route('students.create') }}" class="btn btn-success">Agregar Estudiante</a>

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
