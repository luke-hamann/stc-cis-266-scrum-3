<?php
class Car {
    private $id;
    private $make;
    private $model;
    private $year;
    private $color;
    private $price;

    public function __construct($id, $make, $model, $year, $color, $price) {
        $this->id = $id;
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
        $this->color = $color;
        $this->price = $price;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getMake() {
        return $this->make;
    }

    public function setMake($make) {
        $this->make = $make;
    }

    public function getModel() {
        return $this->model;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function getYear() {
        return $this->year;
    }

    public function setYear($year) {
        $this->year = $year;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }
}
?>
