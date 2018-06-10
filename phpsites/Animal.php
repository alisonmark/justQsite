<?php
/**
* 
*/
include 'Person.php';
include 'Package\Computer.php';

use PersonNameSpace\Person;
use Laptop\Laptop;
use Laptop\Desktop;

// use Laptop\Desktop;

    interface Animal
    {
        public function eating();
        public function drinking();
        public function walking();        
    }

    interface Dogs extends Animal
    {
        const isAnimal = True;
        public function speaking();
    }

    interface Human
    {
        const isAnimal2 = False;
        public function speaking();
    }

    class vietNamDogs implements Dogs, Human
    {
        public $name;
        public static $country = 'Việt Nam';

        public function getName()
        {
            return $this->name;
        }

        public static function getCoutry()
        {
            return self::$country;
        }

        public function ShowAll()
        {
            echo('<br>All infor of dog is : Name : '.$this->getName().' - Country : '.vietNamDogs::getCoutry().'<br>');
        }

        public function eating()
        {
            echo('Tôi ăn thịt.<br>');
        }

        public function drinking()
        {
            echo('Tôi uống nước.<br>');
        }

        public function walking()
        {
            echo('Tôi đi bẳng 4 chân.<br>');
        }

        public function speaking()
        {
            echo('Tôi là giống chó của Việt Nam.<br>');
        }
    }

    $vnDog = new vietNamDogs();
    $vnDog->name = 'Chó Phú Quốc';
    // print_r($vnDog);
    $dogName = $vnDog->getName();
    $dogCountry = $vnDog->getCoutry();
    
    echo("<br>Đất nước của tôi trước kia là : $dogCountry <br>");
    echo "<br>Tên tôi là : $dogName <br>";

    $vnDog::$country = 'Japanese';
    $dogCountry = $vnDog->getCoutry();
    echo("<br>Đất nước của tôi bây giờ là : $dogCountry <br>");

    $jpDog = new vietNamDogs();
    $dogJPCountry = $jpDog->getCoutry();
    echo("<br>Đất nước của tôi khi tạo mới object là : $dogJPCountry <br>");
    echo($jpDog->ShowAll());

    $person01 = new Person('Quân', 29);
    $person01->ShowMe();

    $laptop01 = new Laptop();
    $laptop01->brand = 'ASUS';
    echo('<br>Type of Computer : '.$laptop01->getType(). '<br>');
    $laptop01->ShowInfor();
    echo('<br>Type of Computer : '.$laptop01::$type. '<br>');

    $desktop = new Desktop();
    $desktop->chip = 'Core i5';
    echo('<br>Type of Computer : '.$desktop->getType(). '<br>');
    $desktop->ShowInfor();

?>
