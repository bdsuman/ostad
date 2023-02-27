<?php


class Car{

private $make;
private $model;
private $year;

function __construct($make,$model,$year)
{
    $this->set_make($make);
    $this->set_model($model);
    $this->set_year($year);

}

public function set_make($make) {
    $this->make = $make;
  }
  
  public function get_make() {
    return $this->make;
  }

public function set_model($model) {
    $this->model = $model;
  }
  
  public function get_model() {
    return $this->model;
  }

public function set_year($year) {
    $this->year = $year;
  }
  
  public function get_year() {
    return $this->year;
  }

  function display_info(){
    return 'Car Make : '.$this->get_make().'<br>Car Model: '.$this->get_model().'<br>Car Year: '.$this->get_year();
  }


}

$objectCar = new Car('Toyota','Corolla','2015');

echo $objectCar->display_info();

echo '<br><br>';

$objectCar2 = new Car('Honda','Civic','2015');

echo $objectCar2->display_info();