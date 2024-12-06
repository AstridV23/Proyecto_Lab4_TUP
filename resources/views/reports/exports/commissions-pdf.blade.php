<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Comisiones</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        h2 { color: #333; }
    </style>
</head>
<body>
    <h2>Reporte de Comisiones y Horarios</h2>
    <table>
        <thead>
            <tr>
                <th>Materia</th>
                <th>Curso</th>
                <th>Aula</th>
                <th>Horario</th>
                <th>Profesores</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commissions as $commission)
                <tr>
                    <td>{{ $commission['Materia'] }}</td>
                    <td>{{ $commission['Curso'] }}</td>
                    <td>{{ $commission['Aula'] }}</td>
                    <td>{{ $commission['Horario'] }}</td>
                    <td>{{ $commission['Profesores'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
