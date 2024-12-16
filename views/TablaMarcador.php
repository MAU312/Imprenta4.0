<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Marcadores</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
  <script src="./assets/JavaScript/agregarMarcador.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

  <div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold text-center text-gray-700 mb-6">Gestión de Marcadores</h1>
    
    <div class="overflow-x-auto shadow-md rounded-lg">
      <table class="min-w-full bg-white border-collapse border border-gray-200">
        <thead class="bg-purple-700 text-white">
          <tr>
            <th class="py-2 px-4 border">COLABORADOR</th>
            <th colspan="2" class="py-2 px-4 border">VIERNES</th>
            <th colspan="2" class="py-2 px-4 border">LUNES</th>
            <th colspan="2" class="py-2 px-4 border">MARTES</th>
            <th colspan="2" class="py-2 px-4 border">MIÉRCOLES</th>
            <th colspan="2" class="py-2 px-4 border">JUEVES</th>
            <th colspan="2" class="py-2 px-4 border">SÁBADO</th>
            <th class="py-2 px-4 border">DEBE (HORAS)</th>
            <th class="py-2 px-4 border">ACCIONES</th>
          </tr>
          <tr>
            <th class="py-2 px-4 border"></th>
            <th class="py-2 px-4 border">Entrada</th>
            <th class="py-2 px-4 border">Salida</th>
            <th class="py-2 px-4 border">Entrada</th>
            <th class="py-2 px-4 border">Salida</th>
            <th class="py-2 px-4 border">Entrada</th>
            <th class="py-2 px-4 border">Salida</th>
            <th class="py-2 px-4 border">Entrada</th>
            <th class="py-2 px-4 border">Salida</th>
            <th class="py-2 px-4 border">Entrada</th>
            <th class="py-2 px-4 border">Salida</th>
            <th class="py-2 px-4 border">Entrada</th>
            <th class="py-2 px-4 border">Salida</th>
          </tr>
        </thead>
        <tbody id="tablaMarcadores">
          <!-- Aquí se cargarán las filas dinámicamente con JS -->
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal para agregar/editar datos -->
  <div id="modalMarcador" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded shadow-md w-96">
      <h2 class="text-xl font-bold text-gray-700 mb-4" id="modalTitulo">Agregar Marcador</h2>
      <form id="formMarcador">
        <div class="mb-4">
          <label for="colaborador" class="block text-gray-600">Colaborador</label>
          <input type="text" id="colaborador" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-purple-600" required>
        </div>

        <!-- Viernes -->
        <div class="mb-4">
          <label for="viernes_entrada" class="block text-gray-600">Entrada Viernes</label>
          <input type="time" id="viernes_entrada" class="w-full border-gray-300 rounded px-3 py-2">
        </div>
        <div class="mb-4">
          <label for="viernes_salida" class="block text-gray-600">Salida Viernes</label>
          <input type="time" id="viernes_salida" class="w-full border-gray-300 rounded px-3 py-2">
        </div>

        <!-- Lunes -->
        <div class="mb-4">
          <label for="lunes_entrada" class="block text-gray-600">Entrada Lunes</label>
          <input type="time" id="lunes_entrada" class="w-full border-gray-300 rounded px-3 py-2">
        </div>
        <div class="mb-4">
          <label for="lunes_salida" class="block text-gray-600">Salida Lunes</label>
          <input type="time" id="lunes_salida" class="w-full border-gray-300 rounded px-3 py-2">
        </div>

        <!-- Martes -->
        <div class="mb-4">
          <label for="martes_entrada" class="block text-gray-600">Entrada Martes</label>
          <input type="time" id="martes_entrada" class="w-full border-gray-300 rounded px-3 py-2">
        </div>
        <div class="mb-4">
          <label for="martes_salida" class="block text-gray-600">Salida Martes</label>
          <input type="time" id="martes_salida" class="w-full border-gray-300 rounded px-3 py-2">
        </div>

        <!-- Miércoles -->
        <div class="mb-4">
          <label for="miercoles_entrada" class="block text-gray-600">Entrada Miércoles</label>
          <input type="time" id="miercoles_entrada" class="w-full border-gray-300 rounded px-3 py-2">
        </div>
        <div class="mb-4">
          <label for="miercoles_salida" class="block text-gray-600">Salida Miércoles</label>
          <input type="time" id="miercoles_salida" class="w-full border-gray-300 rounded px-3 py-2">
        </div>

        <!-- Jueves -->
        <div class="mb-4">
          <label for="jueves_entrada" class="block text-gray-600">Entrada Jueves</label>
          <input type="time" id="jueves_entrada" class="w-full border-gray-300 rounded px-3 py-2">
        </div>
        <div class="mb-4">
          <label for="jueves_salida" class="block text-gray-600">Salida Jueves</label>
          <input type="time" id="jueves_salida" class="w-full border-gray-300 rounded px-3 py-2">
        </div>

        <!-- Sábado -->
        <div class="mb-4">
          <label for="sabado_entrada" class="block text-gray-600">Entrada Sábado</label>
          <input type="time" id="sabado_entrada" class="w-full border-gray-300 rounded px-3 py-2">
        </div>
        <div class="mb-4">
          <label for="sabado_salida" class="block text-gray-600">Salida Sábado</label>
          <input type="time" id="sabado_salida" class="w-full border-gray-300 rounded px-3 py-2">
        </div>

        <div class="flex justify-end space-x-4">
          <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded" onclick="cerrarModal()">Cancelar</button>
          <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded">Guardar</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Variables globales
    let datosMarcadores = []; // Aquí se almacenarán los datos de ejemplo

    // Función para cerrar el modal
    function cerrarModal() {
      document.getElementById('modalMarcador').classList.add('hidden');
    }

    // Función para abrir el modal
    function abrirModal(accion, id = null) {
      const modal = document.getElementById('modalMarcador');
      const titulo = document.getElementById('modalTitulo');
      
      if (accion === 'agregar') {
        titulo.textContent = 'Agregar Marcador';
        document.getElementById('formMarcador').reset();
      } else if (accion === 'editar') {
        titulo.textContent = 'Editar Marcador';
        // Cargar datos del marcador en los inputs
        const marcador = datosMarcadores.find(item => item.id === id);
        document.getElementById('colaborador').value = marcador.colaborador;
        document.getElementById('viernes_entrada').value = marcador.viernes_entrada;
        document.getElementById('viernes_salida').value = marcador.viernes_salida;
        document.getElementById('lunes_entrada').value = marcador.lunes_entrada;
        document.getElementById('lunes_salida').value = marcador.lunes_salida;
        document.getElementById('martes_entrada').value = marcador.martes_entrada;
        document.getElementById('martes_salida').value = marcador.martes_salida;
        document.getElementById('miercoles_entrada').value = marcador.miercoles_entrada;
        document.getElementById('miercoles_salida').value = marcador.miercoles_salida;
        document.getElementById('jueves_entrada').value = marcador.jueves_entrada;
        document.getElementById('jueves_salida').value = marcador.jueves_salida;
        document.getElementById('sabado_entrada').value = marcador.sabado_entrada;
        document.getElementById('sabado_salida').value = marcador.sabado_salida;
      }

      modal.classList.remove('hidden');
    }

    // Función para manejar el envío del formulario
    document.getElementById('formMarcador').onsubmit = function(event) {
      event.preventDefault();

      const nuevoMarcador = {
        id: Date.now(), // Crear un ID único (podría ser un autoincremento o UUID en una base de datos real)
        colaborador: document.getElementById('colaborador').value,
        viernes_entrada: document.getElementById('viernes_entrada').value,
        viernes_salida: document.getElementById('viernes_salida').value,
        lunes_entrada: document.getElementById('lunes_entrada').value,
        lunes_salida: document.getElementById('lunes_salida').value,
        martes_entrada: document.getElementById('martes_entrada').value,
        martes_salida: document.getElementById('martes_salida').value,
        miercoles_entrada: document.getElementById('miercoles_entrada').value,
        miercoles_salida: document.getElementById('miercoles_salida').value,
        jueves_entrada: document.getElementById('jueves_entrada').value,
        jueves_salida: document.getElementById('jueves_salida').value,
        sabado_entrada: document.getElementById('sabado_entrada').value,
        sabado_salida: document.getElementById('sabado_salida').value
      };

      // Agregar el nuevo marcador a la lista
      datosMarcadores.push(nuevoMarcador);
      cargarTabla();
      cerrarModal();
    };

    // Función para cargar los datos en la tabla
    function cargarTabla() {
      const tabla = document.getElementById('tablaMarcadores');
      tabla.innerHTML = ''; // Limpiar la tabla

      datosMarcadores.forEach(marcador => {
        const fila = document.createElement('tr');
        fila.innerHTML = `
          <td class="py-2 px-4 border">${marcador.colaborador}</td>
          <td class="py-2 px-4 border">${marcador.viernes_entrada}</td>
          <td class="py-2 px-4 border">${marcador.viernes_salida}</td>
          <td class="py-2 px-4 border">${marcador.lunes_entrada}</td>
          <td class="py-2 px-4 border">${marcador.lunes_salida}</td>
          <td class="py-2 px-4 border">${marcador.martes_entrada}</td>
          <td class="py-2 px-4 border">${marcador.martes_salida}</td>
          <td class="py-2 px-4 border">${marcador.miercoles_entrada}</td>
          <td class="py-2 px-4 border">${marcador.miercoles_salida}</td>
          <td class="py-2 px-4 border">${marcador.jueves_entrada}</td>
          <td class="py-2 px-4 border">${marcador.jueves_salida}</td>
          <td class="py-2 px-4 border">${marcador.sabado_entrada}</td>
          <td class="py-2 px-4 border">${marcador.sabado_salida}</td>
          <td class="py-2 px-4 border">0</td>
          <td class="py-2 px-4 border">
            <button class="bg-blue-500 text-white px-2 py-1 rounded" onclick="abrirModal('editar', ${marcador.id})">Editar</button>
          </td>
        `;
        tabla.appendChild(fila);
      });
    }
  </script>
  

</body>
</html>
