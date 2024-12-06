<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Cursos por Materia</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        h2, h3 { color: #333; }
        .materia { margin-top: 30px; }
    </style>
</head>
<body>
    <h2>Reporte de Cursos por Materia</h2>
    
    @foreach($subjects as $subject)
        <div class="materia">
            <h3>{{ $subject['name'] }}</h3>
            <table>
                <thead>
                    <tr>
                        <th>Curso</th>
                        <th>Comisiones</th>
                        <th>Estudiantes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subject['courses'] as $course)
                        <tr>
                            <td>{{ $course['name'] }}</td>
                            <td>{{ $course['commissions_count'] }} comisiones</td>
                            <td>{{ $course['students_count'] ?? 0 }} estudiantes</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</body>
</html>
