@extends('layouts.invention')

@section('titulo', 'Lista de Comisiones')

@section('contenido')
<h1>Listado de Comisiones</h1>  
<hr>
<div class="botones" style="
    display: flex;
    gap: 20px;
    height: 30px;">
    <a href="{{ route('commissions.create') }}" class="btn btn-success">NUEVO</a>
    <form style="display:flex; gap: 20px">  
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing-sm">Filtrar Curso</span>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing-sm">Filtrar Horario</span>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
    </form>  
</div>

<table class="table table-striped">  
    <thead>  
        <tr>  
            <th >Aula</th>  
            <th >Horario</th>  
            <th class="p20">Curso ID</th>  
            <th class="p20">Acciones</th>  
        </tr>  
    </thead>  
    <tbody>  
        @foreach ($commissions as $commission)  
            <tr>  
                <td >{{ $commission->aula }}</td>  
                <td >{{ $commission->horario }}</td>  
                <td class="p20">{{ $commission->course_id }}</td>  
                <td class="p20">  
                    <a href="{{ route('commissions.edit', $commission) }}" class="btn btn-warning">Editar</a>  
                    <form action="{{ route('commissions.destroy', $commission) }}" method="POST" style="display:inline-block;">  
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
