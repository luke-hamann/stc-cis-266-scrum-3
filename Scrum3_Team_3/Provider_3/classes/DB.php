<?php
require_once 'Car.php';
require_once 'Customer.php';
require_once 'Salesperson.php';

class DB {
    const DB_HOSTNAME = 'localhost';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = '';
    const DB_DATABASE = 'carDealership';

    private $db;

    public function __construct() {
        $dsn = 'mysql:host=' . self::DB_HOSTNAME . ';dbname=' . self::DB_DATABASE;
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        try {
            $this->db = new PDO($dsn, self::DB_USERNAME, self::DB_PASSWORD, $options);
        } catch (PDOException $e) {
            die('Database exception: ' . $e->getMessage());
        }
    }

    private function prepare($sql, $params) {
        try {
            $statement = $this->db->prepare($sql);
            foreach ($params as $key => $value) {
                $statement->bindValue(':' . $key, $value);
            }
            return $statement;
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
    }

    private function select($tableName, $id, $columns) {
        $columnList = implode(', ', $columns);
        $sql = "SELECT $columnList FROM $tableName WHERE id = :id";

        $statement = $this->prepare($sql, ['id' => $id]);
        try {
            $statement->execute();
            $row = $statement->fetch();
            $statement->closeCursor();
            return $row;
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
    }

    private function insert($tableName, $values) {
        $columns = array_keys($values);
        $columnList = implode(', ', $columns);
        $params = implode(', ', preg_filter('/^/', ':', $columns));
        $sql = "INSERT INTO $tableName ($columnList) VALUES ($params)";

        $statement = $this->prepare($sql, $values);
        try {
            $statement->execute();
            $statement->closeCursor();
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
    }

    private function update($tableName, $values) {
        $columns = array_keys($values);
        $changes = [];
        foreach ($columns as $column) {
            if ($column == 'id') continue;
            $changes[] = "$column = :$column";
        }
        $changes = implode(', ', $changes);

        $sql = "UPDATE $tableName SET $changes WHERE id = :id";

        $statement = $this->prepare($sql, $values);
        try {
            $statement->execute();
            $statement->closeCursor();
            return ($statement->rowCount() == 1);
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
    }

    private function delete($tableName, $id) {
        $sql = "DELETE FROM $tableName WHERE id = :id";
        $statement = $this->prepare($sql, ['id' => $id]);
        try {
            $statement->execute();
            $statement->closeCursor();
            return ($statement->rowCount() == 1);
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
    }

    public function insertCar($car) {
        return $this->insert('Cars', [
            'make' => $car->getMake(),
            'model' => $car->getModel(),
            'year' => $car->getYear(),
            'color' => $car->getColor(),
            'price' => $car->getPrice()
        ]);
    }

    public function readCar($id) {
        $row = $this->select('Cars', $id,
            ['id', 'make', 'model', 'year', 'color', 'price']);
        if ($row == null) return null;

        return new Car(
            $row['id'],
            $row['make'],
            $row['model'],
            $row['year'],
            $row['color'],
            $row['price']
        );
    }

    public function updateCar($car) {
        return $this->update('Cars', [
            'id' => $car->getId(),
            'make' => $car->getMake(),
            'model' => $car->getModel(),
            'year' => $car->getYear(),
            'color' => $car->getColor(),
            'price' => $car->getPrice()
        ]);
    }

    public function deleteCar($id) {
        return $this->delete('Cars', $id);
    }

    public function insertCustomer($customer) {
        return $this->insert('Customers', [
            'firstName' => $customer->getFirstName(),
            'lastName' => $customer->getLastName(),
            'phone' => $customer->getPhone(),
            'email' => $customer->getEmail(),
            'address' => $customer->getAddress()
        ]);
    }

    public function readCustomer($id) {
        $row = $this->select('Customers', $id,
            ['id, firstName, lastName, phone, email, address']);
        if ($row == null) return null;

        return new Customer(
            $row['id'],
            $row['firstName'],
            $row['lastName'],
            $row['phone'],
            $row['email'],
            $row['address']
        );
    }

    public function updateCustomer($customer) {
        return $this->update('Customers', [
            'id' => $customer->getId(),
            'firstName' => $customer->getFirstName(),
            'lastName' => $customer->getLastName(),
            'phone' => $customer->getPhone(),
            'email' => $customer->getEmail(),
            'address' => $customer->getAddress()
        ]);
    }

    public function deleteCustomer($id) {
        return $this->delete('Customers', $id);
    }

    public function insertSalesperson($salesperson) {
        return $this->insert('Salespeople', [
            'firstName' => $salesperson->getFirstName(),
            'lastName' => $salesperson->getLastName(),
            'hireDate' => $salesperson->getHireDate(),
            'salary' => $salesperson->getSalary(),
            'commissionPercent' => $salesperson->getCommissionPercent()
        ]);
    }

    public function readSalesperson($id) {
        $row = $this->select('Salespeople', $id,
            ['id', 'firstName', 'lastName', 'hireDate', 'salary', 'commissionPercent']);
        if ($row == null) return null;

        return new Salesperson(
            $row['id'],
            $row['firstName'],
            $row['lastName'],
            $row['hireDate'],
            $row['salary'],
            $row['commissionPercent']
        );
    }

    public function updateSalesperson($salesperson) {
        return $this->update('Salespeople', [
            'id' => $salesperson->getId(),
            'firstName' => $salesperson->getFirstName(),
            'lastName' => $salesperson->getLastName(),
            'hireDate' => $salesperson->getHireDate(),
            'salary' => $salesperson->getSalary(),
            'commissionPercent' => $salesperson->getCommissionPercent()
        ]);
    }

    public function deleteSalesperson($id) {
        return $this->delete('Salespeople', $id);
    }
}
?>
