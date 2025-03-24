<?php
$DB_HOSTNAME = 'localhost';
$DB_USERNAME = 'root';
$DB_PASSWORD = '';
$DB_DATABASE = 'carDealership';

try {
    $dsn = "mysql:host=$DB_HOSTNAME;dbname=$DB_DATABASE";
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    $db = new PDO($dsn, $DB_USERNAME, $DB_PASSWORD, $options);

    $sqls = [
        'SELECT id, make, model, year, color, price FROM Cars',
        'SELECT id, firstName, lastName, phone, email, address FROM Customers',
        'SELECT id, firstName, lastName, hireDate, salary, commissionPercent FROM Salespeople'
    ];

    for ($i = 0; $i < count($sqls); $i++) {
        $statement = $db->prepare($sqls[$i]);
        $statement->execute();
        if ($i == 0) $cars = $statement->fetchAll();
        else if ($i == 1) $customers = $statement->fetchAll();
        else if ($i == 2) $salespeople = $statement->fetchAll();
        $statement->closeCursor();
    }
} catch (PDOException $e) {
    die('Database error: ' . $e->getMessage());
}
?>

<?php function table($headers, $columns, $records) { ?>
    <?php if (count($records) == 0) : ?>
        <p><i>No records found.</i></p>
    <?php else : ?>
        <table>
            <thead>
                <tr>
                    <?php foreach ($headers as $header) : ?>
                        <th>
                            <?= htmlspecialchars($header) ?>
                        </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record) : ?>
                    <tr>
                        <?php foreach ($columns as $column) : ?>
                            <td>
                                <?= htmlspecialchars($record[$column]) ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php } ?>

<?php function formInput($label, $type, $name, $id) { ?>
    <div>
        <label for="<?= $id ?>"><?= $label ?></label>
        <input type="<?= $type ?>" name="<?= $name ?>" id="<?= $id ?>" />
    </div>
<?php } ?>

<?php function formButtons() { ?>
    <div>
        <input type="submit" value="Submit" />
        <input type="reset" value="Reset" />
    </div>
<?php } ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testers</title>
</head>
<body>
    <h1>Testers</h1>
    <p><a href="../../Client_3/">Back</a></p>
    <h2>Tables</h2>
    <h3>Cars</h3>
    <?= table(
        ['#', 'Make', 'Model', 'Year', 'Color', 'Price'],
        ['id', 'make', 'model', 'year', 'color', 'price'],
        $cars
    ) ?>
    <h3>Customers</h3>
    <?= table(
        ['#', 'First name', 'Last name', 'Phone', 'Email', 'Address'],
        ['id', 'firstName', 'lastName', 'phone', 'email', 'address'],
        $customers
    ) ?>
    <h3>Salespeople</h3>
    <?= table(
        ['#', 'First name', 'Last name', 'Hire date', 'Salary', 'Commission percent'],
        ['id', 'firstName', 'lastName', 'hireDate', 'salary', 'commissionPercent'],
        $salespeople
    ) ?>
    <h2>API Functions</h2>
    <h3>Cars CRUD</h3>
    <h4>Create Car</h4>
    <form action="../API_3/carCreate.php" method="post">
        <?= formInput('Make:', 'text', 'make', 'carCreateMake') ?>
        <?= formInput('Model:', 'text', 'model', 'carCreateModel') ?>
        <?= formInput('Year:', 'number', 'year', 'carCreateYear') ?>
        <?= formInput('Color:', 'text', 'color', 'carCreateColor') ?>
        <?= formInput('Price:', 'number', 'price', 'carCreatePrice') ?>
        <?= formButtons() ?>
    </form>
    <h4>Read Car</h4>
    <form action="../API_3/carRead.php" method="get">
        <?= formInput('Id:', 'number', 'id', 'carReadId') ?>
        <?= formButtons() ?>
    </form>
    <h4>Update Car</h4>
    <form action="../API_3/carUpdate.php" method="post">
        <?= formInput('Id:', 'number', 'id', 'carUpdateId') ?>
        <?= formInput('Make:', 'text', 'make', 'carUpdateMake') ?>
        <?= formInput('Model:', 'text', 'model', 'carUpdateModel') ?>
        <?= formInput('Year:', 'number', 'year', 'carUpdateYear') ?>
        <?= formInput('Color:', 'text', 'color', 'carUpdateColor') ?>
        <?= formInput('Price:', 'number', 'price', 'carUpdatePrice') ?>
        <?= formButtons() ?>
    </form>
    <h4>Delete Car</h4>
    <form action="../API_3/carDelete.php" method="post">
        <?= formInput('Id:', 'number', 'id', 'carDeleteId') ?>
        <?= formButtons() ?>
    </form>
    <h3>Customers CRUD</h3>
    <h4>Create Customer</h4>
    <form action="../API_3/customerCreate.php" method="post">
        <?= formInput('First name:', 'text', 'firstName', 'customerCreateFirstName') ?>
        <?= formInput('Last name:', 'text', 'lastName', 'customerCreateLastName') ?>
        <?= formInput('Phone:', 'text', 'phone', 'customerCreatePhone') ?>
        <?= formInput('Email:', 'email', 'email', 'customerCreateEmail') ?>
        <?= formInput('Address:', 'text', 'address', 'customerCreateAddress') ?>
        <?= formButtons() ?>
    </form>
    <h4>Read Customer</h4>
    <form action="../API_3/customerRead.php" method="get">
        <?= formInput('Id:', 'number', 'id', 'customerReadId') ?>
        <?= formButtons() ?>
    </form>
    <h4>Update Customer</h4>
    <form action="../API_3/customerUpdate.php" method="post">
        <?= formInput('Id:', 'number', 'id', 'customerUpdateId') ?>
        <?= formInput('First name:', 'text', 'firstName', 'customerUpdateFirstName') ?>
        <?= formInput('Last name:', 'text', 'lastName', 'customerUpdateLastName') ?>
        <?= formInput('Phone:', 'text', 'phone', 'customerUpdatePhone') ?>
        <?= formInput('Email:', 'email', 'email', 'customerUpdateEmail') ?>
        <?= formInput('Address:', 'text', 'address', 'customerUpdateAddress') ?>
        <?= formButtons() ?>
    </form>
    <h4>Delete Customer</h4>
    <form action="../API_3/customerDelete.php" method="post">
        <?= formInput('Id:', 'number', 'id', 'customerDeleteId') ?>
        <?= formButtons() ?>
    </form>
    <h3>Salespeople CRUD</h3>
    <h4>Create Salesperson</h4>
    <form action="../API_3/salespersonCreate.php" method="post">
        <?= formInput('First name:', 'text', 'firstName', 'salespersonCreateFirstName') ?>
        <?= formInput('Last name:', 'text', 'lastName', 'salespersonCreateLastName') ?>
        <?= formInput('Hire date:', 'date', 'hireDate', 'salespersonCreateHireDate') ?>
        <?= formInput('Salary:', 'number', 'salary', 'salespersonCreateSalary') ?>
        <?= formInput('Commission percent:', 'number', 'commissionPercent', 'salespersonCreateCommissionPercent') ?>
        <?= formButtons() ?>
    </form>
    <h4>Read Salesperson</h4>
    <form action="../API_3/salespersonRead.php" method="get">
        <?= formInput('Id:', 'number', 'id', 'salespersonReadId') ?>
        <?= formButtons() ?>
    </form>
    <h4>Update Salesperson</h4>
    <form action="../API_3/salespersonUpdate.php" method="post">
        <?= formInput('Id:', 'number', 'id', 'salespersonUpdateId') ?>
        <?= formInput('First name:', 'text', 'firstName', 'salespersonUpdateFirstName') ?>
        <?= formInput('Last name:', 'text', 'lastName', 'salespersonUpdateLastName') ?>
        <?= formInput('Hire date:', 'date', 'hireDate', 'salespersonUpdateHireDate') ?>
        <?= formInput('Salary:', 'number', 'salary', 'salespersonUpdateSalary') ?>
        <?= formInput('Commission percent:', 'number', 'commissionPercent', 'salespersonUpdateCommissionPercent') ?>
        <?= formButtons() ?>
    </form>
    <h4>Delete Salesperson</h4>
    <form action="../API_3/salespersonDelete.php" method="post">
        <?= formInput('Id:', 'number', 'id', 'salespersonDeleteId') ?>
        <?= formButtons() ?>
    </form>
</body>
</html>
