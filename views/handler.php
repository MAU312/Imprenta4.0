<?php

// Configuración de PHP
ini_set('allow_url_fopen', 1);

// Rutas de archivos PHP en /views
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
  // Rutas de páginas PHP
  case '/':
  case '/index':
  case '/index.php':
      require '/views/index.php';
      break;
  case '/login':
  case '/login.php':
      require '/views/login.php';
      break;
  case '/empleados':
  case '/listaEmpleados.php':
      require '/views/listaEmpleados.php';
      break;
  case '/produccion':
  case '/produccion.php':
      require '/views/produccion.php';
      break;
  case '/orden-produccion':
  case '/OrdenProduccionAC.php':
      require '/views/OrdenProduccionAC.php';
      break;
  case '/agregarDetalleEntrada.php':
      require '/views/agregarDetalleEntrada.php';
      break;
  case '/agregarEmpleado.php':
      require '/views/agregarEmpleado.php';
      break;
  case '/agregarHoras.php':
      require '/views/agregarHoras.php';
      break;
  case '/agregarHoras2.php':
      require '/views/agregarHoras2.php';
      break;
  case '/agregarUsuarios.php':
      require '/views/AgregarUsuarios.php';
      break;
  case '/detalleEmpleado.php':
      require '/views/detalleEmpleado.php';
      break;
  case '/detalleMaterial.php':
      require '/views/detalleMaterial.php';
      break;
  case '/editarEmpleado.php':
      require '/views/editarEmpleado.php';
      break;
  case '/granFormato.php':
      require '/views/granFromato.php';
      break;
  case '/hola.php':
      require '/views/hola.php';
      break;
  case '/indexDetalleEntrada.php':
      require '/views/indexDetalleEntrada.php';
      break;
  case '/prueba.php':
      require '/views/prueba.php';
      break;
  case '/tablaMarcador.php':
      require '/views/TablaMarcador.php';
      break;
  case '/tablaMateriales.php':
      require '/views/tablaMateriales.php';
      break;
  case '/calendario.html':
      require '/views/calendario.html';
      break;
  case '/calendariocopy.php':
      require '/views/calendariocopy.php';
      break;
  
  // Rutas de controladores
  case '/registro':
      require __DIR__ . '/controllers/RegistroController.php';
      break;
  case '/loginController':
      require __DIR__ . '/controllers/LoginController.php';
      break;
  case '/empleadosController':
      require __DIR__ . '/controllers/EmpleadosController.php';
      break;

  // Si no se encuentra la ruta, devolver 404
  default:
      http_response_code(404);
      echo "Ruta no encontrada: " . htmlspecialchars($request_path);
      exit;
}

?>
