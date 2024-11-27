@extends('layouts.invention')

@section('titulo', 'Lista de Cursos')

@section('contenido')
<h1>Listado de Cursos</h1>  
<hr>
<div class="botones" style="
    display: flex;
    gap: 20px;
    height: 30px;">
    <a href="{{ route('courses.create') }}" class="btn btn-success">NUEVO</a>
    <form style="display:flex; gap: 20px">  
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing-sm">Filtrar Materia</span>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing-sm">Filtrar Comision</span>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
    </form>  
</div>

<table class="table table-striped">  
    <thead>  
        <tr>  
            <th >Nombre</th>   
            <th class="p25">Acciones</th>  
        </tr>  
    </thead>  
    <tbody>  
        @foreach ($courses as $course)  
            <tr>  
                <td >{{ $course->name }}</td>  
                <td class="p25">  
                    <a href="{{ route('courses.edit', $course) }}" class="btn btn-info">Ver</a>  
                    <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning">Editar</a>  
                    <form action="{{ route('courses.destroy', $course) }}" method="POST" style="display:inline-block;">  
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
