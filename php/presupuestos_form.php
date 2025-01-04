<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Presupuestos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
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
    <h1>Planificar Presupuestos</h1>

    <!-- Formulario para planificar presupuestos -->
    <section>
        <h2>Planificar Presupuestos</h2>
        <form id="budgetForm" action="insert_budget.php" method="POST">
            <label for="income">Ingresos Esperados:</label>
            <input type="number" id="income" name="income" required><br>
            <label for="expenses">Gastos Esperados:</label>
            <input type="number" id="expenses" name="expenses" required><br>
            <label for="description">Descripción:</label>
            <input type="text" id="description" name="description" required><br>
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
