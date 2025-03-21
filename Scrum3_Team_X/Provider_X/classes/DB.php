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
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        try {
            $this->db = new PDO(
                $dsn,
                self::DB_USERNAME,
                self::DB_PASSWORD,
                $options
            );
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

    private function select($sql, $params) {
        $statement = $this->prepare($sql, $params);
        try {
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            return $result;
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
    }

    private function insert($sql, $params) {
        $statement = $this->prepare($sql, $params);
        try {
            $statement->execute();
            $statement->closeCursor();
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
    }

    private function update($sql, $params) {
        $statement = $this->prepare($sql, $params);
        try {
            $statement->execute();
            $statement->closeCursor();
            return ($statement->rowCount() == 1);
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
    }

    private function delete($sql, $params) {
        return $this->update($sql, $params);
    }

    public function insertCar($car) {
        $sql = '
            INSERT INTO Cars (make, model, year, color, price)
            VALUES (:make, :model, :year, :color, :price)
        ';

        $params = array(
            'make' => $car->getMake(),
            'model' => $car->getModel(),
            'year' => $car->getYear(),
            'color' => $car->getColor(),
            'price' => $car->getPrice()
        );

       return $this->insert($sql, $params);
    }

    public function readCar($id) {
        $sql = '
            SELECT id, make, model, year, color, price
            FROM Cars
            WHERE id = :id
        ';

        $params = array('id' => $id);

        $rows = $this->select($sql, $params);
        if (count($rows) == 0) return null;

        $row = $rows[0];

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
        $sql = '
            UPDATE Cars
            SET make = :make,
                model = :model,
                year = :year,
                color = :color,
                price = :price
            WHERE id = :id
        ';

        $params = array(
            'make' => $car->getMake(),
            'model' => $car->getModel(),
            'year' => $car->getYear(),
            'color' => $car->getColor(),
            'price' => $car->getPrice(),
            'id' => $car->getId()
        );

        return $this->update($sql, $params);
    }

    public function deleteCar($id) {
        $sql = '
            DELETE FROM Cars
            WHERE id = :id
        ';

        $params = array('id' => $id);

        return $this->delete($sql, $params);
    }

    public function insertCustomer($customer) {
        $sql = '
            INSERT INTO Customers (firstName, lastName, phone, email, address)
            VALUES (:firstName, :lastName, :phone, :email, :address)
        ';

        $params = array(
            'firstName' => $customer->getFirstName(),
            'lastName' => $customer->getLastName(),
            'phone' => $customer->getPhone(),
            'email' => $customer->getEmail(),
            'address' => $customer->getAddress()
        );

        return $this->insert($sql, $params);
    }

    public function readCustomer($id) {
        $sql = '
            SELECT id, firstName, lastName, phone, email, address
            FROM Customers
            WHERE id = :id;
        ';

        $params = array('id' => $id);

        $rows = $this->select($sql, $params);
        if (count($rows) == 0) return null;
        $row = $rows[0];

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
        $sql = '
            UPDATE Customers
            SET firstName = :firstName,
                lastName = :lastName,
                phone = :phone,
                email = :email,
                address = :address
            WHERE id = :id
        ';

        $params = array(
            'firstName' => $customer->getFirstName(),
            'lastName' => $customer->getLastName(),
            'phone' => $customer->getPhone(),
            'email' => $customer->getEmail(),
            'address' => $customer->getAddress(),
            'id' => $customer->getId()
        );

        return $this->update($sql, $params);
    }

    public function deleteCustomer($id) {
        $sql = '
            DELETE FROM Customers
            WHERE id = :id
        ';

        $params = array('id' => $id);

        return $this->delete($sql, $params);
    }

    public function insertSalesperson($salesperson) {
        $sql = '
            INSERT INTO Salespeople (firstName, lastName, hireDate, salary, commissionPercent)
            VALUES (:firstName, :lastName, :hireDate, :salary, :commissionPercent)
        ';

        $params = array(
            'firstName' => $salesperson->getFirstName(),
            'lastName' => $salesperson->getLastName(),
            'hireDate' => $salesperson->getHireDate(),
            'salary' => $salesperson->getSalary(),
            'commissionPercent' => $salesperson->getCommissionPercent()
        );

        return $this->insert($sql, $params);
    }

    public function readSalesperson($id) {
        $sql = '
            SELECT id, firstName, lastName, hireDate, salary, commissionPercent
            FROM Salespeople
            WHERE id = :id;
        ';

        $params = array('id' => $id);

        $rows = $this->select($sql, $params);
        if (count($rows) == 0) return null;
        $row = $rows[0];

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
        $sql = '
            UPDATE Salespeople
            SET firstName = :firstName,
                lastName = :lastName,
                hireDate = :hireDate,
                salary = :salary,
                commissionPercent = :commissionPercent
            WHERE id = :id
        ';

        $params = array(
            'firstName' => $salesperson->getFirstName(),
            'lastName' => $salesperson->getLastName(),
            'hireDate' => $salesperson->getHireDate(),
            'salary' => $salesperson->getSalary(),
            'commissionPercent' => $salesperson->getCommissionPercent(),
            'id' => $salesperson->getId()
        );

        return $this->update($sql, $params);
    }

    public function deleteSalesperson($id) {
        $sql = '
            DELETE FROM Salespeople
            WHERE id = :id
        ';

        $params = array('id' => $id);

        return $this->delete($sql, $params);
    }
}
?>
