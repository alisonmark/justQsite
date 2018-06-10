<?php
    class ConNguoi
    {
        private $name;
    
        // public function __set($key, $value)
        // {
        //     //kiểm tra xem trong class có tồn tại thuộc tính không
        //     if (property_exists($this, $key)) {
        //         //tiến hành gán giá trị
        //         $this->$key = $value;
        //     } else {
        //         die('Không tồn tại thuộc tính');
        //     }
        // }
    
        public function getName()
        {
            echo $this->name;
        }
    }
    
    $connguoi = new ConNguoi();
    
    $connguoi->name = "Vũ Thanh Tài";
    
    $connguoi->getName();
    
    //Vũ Thanh Tài
    $connguoi->age = 20;
?>