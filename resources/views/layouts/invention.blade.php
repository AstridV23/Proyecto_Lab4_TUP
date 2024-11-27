<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>@yield('titulo')</title>
 <!-- Bootstrap 5 CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
 {{-- {{ asset('css/app.css') }} --}}
<link href= {{ asset('css/style.css') }} rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
  <div id="content">
    <div id="header">
      <div id="logo">
        <h1>UTN</h1>
        <h4>Laboratorio de Computacion 4</h4>
      </div>
      <div id="links">
        <ul> 
          <li><a href="{{ route('students.index') }}">Estudiantes</a></li>        
          <li><a href="{{ route('professors.index') }}">Profesores</a></li>  
          <li><a href="{{ route('subjects.index') }}">Materias</a></li>    
          <li><a href="{{ route('courses.index') }}">Cursos</a></li>  
          <li><a href="{{ route('commissions.index') }}">Comisiones</a></li>  
        </ul>
      </div>
    </div>
    <div id="mainimg">
      <h3>Gestor Escolar</h3>
      <h4>Proyecto CRUD</h4>
    </div>
    <div id="contentarea">
      <div id="leftbar">
        @yield('contenido')
      </div>
    </div>
    <div id="bottom">
      
    </div>
  </div>
</div>
 <!-- Bootstrap 5 JS -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
