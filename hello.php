<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Elegante</title>
    <style>
        :root {
            --primary: #4a6baf;
            --secondary: #3a5a9f;
            --accent: #f72585;
            --dark: #2d3436;
            --light: #f8f9fa;
            --gray: #adb5bd;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }
        
        body {
            background: 
                linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                url('shrek.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .calculadora {
            width: 100%;
            max-width: 320px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .display {
            padding: 25px 20px;
            background: rgba(45, 52, 54, 0.9);
            color: white;
            text-align: right;
            min-height: 100px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }
        
        .operacion {
            font-size: 1.2rem;
            color: var(--gray);
            margin-bottom: 5px;
            min-height: 1.5rem;
            word-break: break-all;
        }
        
        .resultado {
            font-size: 2rem;
            font-weight: 500;
        }
        
        .teclado {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.95);
        }
        
        .btn {
            padding: 15px;
            border: none;
            border-radius: 10px;
            font-size: 1.2rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            background: var(--light);
            color: var(--dark);
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .btn-operacion {
            background: var(--primary);
            color: white;
        }
        
        .btn-igual {
            background: var(--accent);
            color: white;
            grid-column: span 2;
        }
        
        .btn-limpiar {
            background: var(--light);
            color: var(--accent);
            font-weight: bold;
        }
        
        @media (max-width: 400px) {
            .calculadora {
                border-radius: 15px;
            }
            
            .display {
                padding: 20px 15px;
                min-height: 90px;
            }
            
            .btn {
                padding: 12px;
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <div class="calculadora">
        <div class="display">
            <div class="operacion" id="operacion">0</div>
            <div class="resultado" id="resultado"></div>
        </div>
        
        <div class="teclado">
            <button class="btn" onclick="presionarNumero('7')">7</button>
            <button class="btn" onclick="presionarNumero('8')">8</button>
            <button class="btn" onclick="presionarNumero('9')">9</button>
            <button class="btn btn-operacion" onclick="presionarOperacion('÷')">÷</button>
            
            <button class="btn" onclick="presionarNumero('4')">4</button>
            <button class="btn" onclick="presionarNumero('5')">5</button>
            <button class="btn" onclick="presionarNumero('6')">6</button>
            <button class="btn btn-operacion" onclick="presionarOperacion('×')">×</button>
            
            <button class="btn" onclick="presionarNumero('1')">1</button>
            <button class="btn" onclick="presionarNumero('2')">2</button>
            <button class="btn" onclick="presionarNumero('3')">3</button>
            <button class="btn btn-operacion" onclick="presionarOperacion('-')">-</button>
            
            <button class="btn btn-limpiar" onclick="limpiar()">C</button>
            <button class="btn" onclick="presionarNumero('0')">0</button>
            <button class="btn btn-igual" onclick="calcular()">=</button>
            <button class="btn btn-operacion" onclick="presionarOperacion('+')">+</button>
        </div>
    </div>

    <script>
        // Variables de estado
        let num1 = '';
        let num2 = '';
        let operacion = '';
        let displayOperacion = '0';
        let resultado = '';

        // Elementos del DOM
        const operacionElement = document.getElementById('operacion');
        const resultadoElement = document.getElementById('resultado');

        // Función para actualizar el display
        function actualizarDisplay() {
            operacionElement.textContent = displayOperacion;
            resultadoElement.textContent = resultado;
        }

        // Función para presionar números
        function presionarNumero(num) {
            if (operacion === '') {
                num1 += num;
                displayOperacion = num1;
            } else {
                num2 += num;
                displayOperacion = num1 + ' ' + operacion + ' ' + num2;
            }
            actualizarDisplay();
        }

        // Función para presionar operaciones
        function presionarOperacion(op) {
            if (num1 !== '') {
                operacion = op;
                displayOperacion = num1 + ' ' + operacion;
                actualizarDisplay();
            }
        }

        // Función para calcular resultado
        function calcular() {
            if (num1 !== '' && num2 !== '' && operacion !== '') {
                const n1 = parseFloat(num1);
                const n2 = parseFloat(num2);
                
                switch (operacion) {
                    case '+':
                        resultado = n1 + n2;
                        break;
                    case '-':
                        resultado = n1 - n2;
                        break;
                    case '×':
                        resultado = n1 * n2;
                        break;
                    case '÷':
                        resultado = n2 !== 0 ? n1 / n2 : 'Error';
                        break;
                }
                
                displayOperacion = num1 + ' ' + operacion + ' ' + num2 + ' =';
                actualizarDisplay();
                
                // Resetear para nueva operación
                num1 = resultado.toString();
                num2 = '';
                operacion = '';
            }
        }

        // Función para limpiar
        function limpiar() {
            num1 = '';
            num2 = '';
            operacion = '';
            displayOperacion = '0';
            resultado = '';
            actualizarDisplay();
        }

        // Inicializar display
        actualizarDisplay();
    </script>
</body>
</html>