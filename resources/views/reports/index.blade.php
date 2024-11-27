@extends('layouts.invention')

@section('titulo', 'Reportes del Sistema')

@section('contenido')
<div class="container">
    <h2 class="mb-4">Reportes del Sistema</h2>

    <div class="row">
        <!-- Reporte de Estudiantes -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-user-graduate me-2"></i>Estudiantes Inscritos</h5>
                    <p class="card-text">Lista de estudiantes con sus cursos y comisiones</p>
                    <a href="{{ route('reports.students') }}" class="btn btn-primary">Ver Reporte</a>
                </div>
            </div>
        </div>

        <!-- Reporte de Cursos por Materia -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-book me-2"></i>Cursos por Materia</h5>
                    <p class="card-text">Cursos agrupados por materia</p>
                    <a href="{{ route('reports.courses') }}" class="btn btn-primary">Ver Reporte</a>
                </div>
            </div>
        </div>

        <!-- Reporte de Comisiones -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-user-friends me-2"></i>Comisiones y Horarios</h5>
                    <p class="card-text">Comisiones con aulas, horarios y profesores</p>
                    <a href="{{ route('reports.commissions') }}" class="btn btn-primary">Ver Reporte</a>
                </div>
            </div>
        </div>

        <!-- Reporte de Profesores -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-chalkboard-teacher me-2"></i>Asistencia de Profesores</h5>
                    <p class="card-text">Profesores y sus comisiones asignadas</p>
                    <a href="{{ route('reports.professors') }}" class="btn btn-primary">Ver Reporte</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
