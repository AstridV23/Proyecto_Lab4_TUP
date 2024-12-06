<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Profesores</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        h2 { color: #333; }
    </style>
</head>
<body>
    <h2>Reporte de Asistencia de Profesores</h2>
    <table>
        <thead>
            <tr>
                <th>Profesor</th>
                <th>Email</th>
                <th>Comisiones</th>
                <th>Horarios</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($professors as $professor)
                <tr>
                    <td>{{ $professor['Profesor'] }}</td>
                    <td>{{ $professor['Email'] }}</td>
                    <td>{{ $professor['Comisiones'] }}</td>
                    <td>{{ $professor['Horarios'] }}</td>
                    <td>{{ $professor['Estado'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
