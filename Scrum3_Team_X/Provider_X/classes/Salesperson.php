<?php
class Salesperson {
    private $id;
    private $firstName;
    private $lastName;
    private $hireDate;
    private $salary;
    private $commissionPercent;

    public function __construct($id, $firstName, $lastName, $hireDate, $salary, $commissionPercent) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->hireDate = $hireDate;
        $this->salary = $salary;
        $this->commissionPercent = $commissionPercent;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getHireDate() {
        return $this->hireDate;
    }

    public function setHireDate($hireDate) {
        $this->hireDate = $hireDate;
    }

    public function getSalary() {
        return $this->salary;
    }

    public function setSalary($salary) {
        $this->salary = $salary;
    }

    public function getCommissionPercent() {
        return $this->commissionPercent;
    }

    public function setCommissionPercent($commissionPercent) {
        $this->commissionPercent = $commissionPercent;
    }
}
?>
