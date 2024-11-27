<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            min-height: 100vh;
            background-color: #f5f6f8;
        }

        .menu-lateral {
            background-color: #2c3e50;
            width: 250px;
            padding: 1rem;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .contenido-principal {
            flex: 1;
            margin-left: 250px;
            padding: 2rem;
            min-height: 100vh;
            background-color: #f5f6f8;
        }

        .menu-lateral h2 {
            color: #fff;
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .menu-lateral a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            padding: 0.75rem 1rem;
            display: block;
            border-radius: 4px;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .menu-lateral a:hover {
            background-color: rgba(255,255,255,0.1);
            color: #fff;
        }

        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            border-radius: 8px;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 1rem 1.5rem;
        }

        .form-control, .form-select {
            border-radius: 6px;
            border: 1px solid #e0e0e0;
            padding: 0.6rem 1rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #2c3e50;
            box-shadow: 0 0 0 0.2rem rgba(44,62,80,0.1);
        }

        .btn {
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="menu-lateral">
        <h2>Sistema Escolar</h2>
        <a href="{{ route('students.index') }}"><i class="fas fa-users me-2"></i>Estudiantes</a>
        <a href="{{ route('courses.index') }}"><i class="fas fa-book me-2"></i>Cursos</a>
        <a href="{{ route('professors.index') }}"><i class="fas fa-chalkboard-teacher me-2"></i>Profesores</a>
        <a href="{{ route('subjects.index') }}"><i class="fas fa-book-open me-2"></i>Materias</a>
        <a href="{{ route('commissions.index') }}"><i class="fas fa-users-class me-2"></i>Comisiones</a>
    </div>

    <div class="contenido-principal">
        @yield('contenido')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
