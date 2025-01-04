<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Presupuestos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
        }
        section {
            margin: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="number"], input[type="text"] {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <header>
        <h1>Sistema de Presupuestos</h1>
    </header>

    <!-- Formulario para planificar presupuestos -->
    <section>
        <h2>Planificar Presupuestos</h2>
        <form id="budgetForm" action="presupuesto_insertar.php" method="POST">
            <label for="income">Ingresos Esperados:</label>
            <input type="number" id="income" name="income" required>
            <label for="expenses">Gastos Esperados:</label>
            <input type="number" id="expenses" name="expenses" required>
            <label for="description">Descripción:</label>
            <input type="text" id="description" name="description" required>
            <button type="submit">Guardar Presupuesto</button>
        </form>
    </section>

    <!-- Visualizar presupuestos -->
    <section>
        <h2>Visualizar Presupuestos</h2>
        <div id="budgetOverview">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ingresos</th>
                        <th>Gastos</th>
                        <th>Balance</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se mostrarán los presupuestos -->
                    <?php include 'presupuesto_visualizar.php'; ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Sugerir límites de gastos -->
    <section>
        <h2>Sugerir Límites de Gastos</h2>
        <div id="spendingLimits">
            <?php include 'presupuesto_limitedegasto.php'; ?>
        </div>
    </section>
</body>
</html>
