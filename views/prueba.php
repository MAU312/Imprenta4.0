<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Toggle Switch</title>
</head>

<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="relative inline-block w-64">
            <!-- Radio buttons -->
            <input type="radio" name="toggle" id="option1" class="hidden" onchange="updateToggle()" checked>
            <input type="radio" name="toggle" id="option2" class="hidden" onchange="updateToggle()">
            <input type="radio" name="toggle" id="option3" class="hidden" onchange="updateToggle()">

            <!-- Labels with larger clickable area -->
            <div class="flex justify-between bg-gray-300 rounded-full p-1">
                <label id="label1" for="option1" class="flex-1 cursor-pointer py-3 text-center rounded-full">1</label>
                <label id="label2" for="option2" class="flex-1 cursor-pointer py-3 text-center rounded-full">2</label>
                <label id="label3" for="option3" class="flex-1 cursor-pointer py-3 text-center rounded-full">3</label>
            </div>

            <!-- Toggle Indicator -->
            <div id="toggle-indicator" class="absolute top-0 left-0 bg-blue-500 rounded-full w-1/3 h-full transition-transform duration-300" style="transform: translateX(0);"></div>
        </div>
    </div>

    <script>
        function updateToggle() {
            const option1 = document.getElementById('option1');
            const option2 = document.getElementById('option2');
            const option3 = document.getElementById('option3');
            const indicator = document.getElementById('toggle-indicator');

            if (option1.checked) {
                indicator.style.transform = 'translateX(0)'; // Mueve el indicador a la izquierda
                indicator.style.backgroundColor = 'green'; // Color para opción 1
            } else if (option2.checked) {
                indicator.style.transform = 'translateX(100%)'; // Mueve el indicador al medio
                indicator.style.backgroundColor = 'red'; // Color para opción 2
            } else if (option3.checked) {
                indicator.style.transform = 'translateX(200%)'; // Mueve el indicador a la derecha
                indicator.style.backgroundColor = 'blue'; // Color para opción 3
            }
        }
    </script>

</body>

</html>
