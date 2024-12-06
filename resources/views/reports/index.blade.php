@extends('layouts.invention')

@section('titulo', 'Reportes del Sistema')

@section('contenido')
<div class="container-fluid px-4">
    <h2 class="mb-4">Reportes del Sistema</h2>

    <div class="row g-4">
        <!-- Reporte de Estudiantes -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-primary bg-gradient fs-4 rounded-3 me-3">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h5 class="card-title mb-0">Estudiantes Inscritos</h5>
                    </div>
                    <p class="card-text text-muted flex-grow-1">Lista detallada de estudiantes con sus cursos y comisiones asignadas.</p>
                    <a href="{{ route('reports.students') }}" class="btn btn-primary">
                        <i class="fas fa-chart-bar me-2"></i>Ver Reporte
                    </a>
                </div>
            </div>
        </div>

        <!-- Reporte de Cursos -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-success bg-gradient fs-4 rounded-3 me-3">
                            <i class="fas fa-book"></i>
                        </div>
                        <h5 class="card-title mb-0">Cursos por Materia</h5>
                    </div>
                    <p class="card-text text-muted flex-grow-1">Visualización de cursos organizados por materia académica.</p>
                    <a href="{{ route('reports.courses') }}" class="btn btn-success">
                        <i class="fas fa-chart-pie me-2"></i>Ver Reporte
                    </a>
                </div>
            </div>
        </div>

        <!-- Reporte de Comisiones -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-info bg-gradient fs-4 rounded-3 me-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <h5 class="card-title mb-0">Comisiones y Horarios</h5>
                    </div>
                    <p class="card-text text-muted flex-grow-1">Detalle de comisiones con aulas, horarios y profesores asignados.</p>
                    <a href="{{ route('reports.commissions') }}" class="btn btn-info text-white">
                        <i class="fas fa-clock me-2"></i>Ver Reporte
                    </a>
                </div>
            </div>
        </div>

        <!-- Reporte de Profesores -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-warning bg-gradient fs-4 rounded-3 me-3">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h5 class="card-title mb-0">Asistencia de Profesores</h5>
                    </div>
                    <p class="card-text text-muted flex-grow-1">Registro de profesores con sus comisiones y horarios asignados.</p>
                    <a href="{{ route('reports.professors') }}" class="btn btn-warning text-dark">
                        <i class="fas fa-clipboard-list me-2"></i>Ver Reporte
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.feature-icon-small {
    width: 48px;
    height: 48px;
    background-color: rgba(var(--bs-primary-rgb), 0.1);
}
</style>
@endsection