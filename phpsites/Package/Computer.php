<?php

namespace Laptop;
class Laptop
{
    public $brand;
    public static $type = 'LAPTOP';
    final public function getType()
    {
        return self::$type;
    }

    public function ShowInfor()
    {
        echo "<br>Brand of Laptop is : $this->brand<br>";
    }
}

// namespace Desktop;
class Desktop
{
    public $brand = 'INTEL';
    public static $type = 'DESKTOP';
    public $chip;
    final public function getType()
    {
        return self::$type;
    }

    public function ShowInfor()
    {
        echo "<br>Brand of Desktop is : $this->brand - Chip is : $this->chip<br>";
    }
}

?>
