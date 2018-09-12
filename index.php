<?php

class Objects{
    public static $name = 'Alex';
    public static $status = 1;
}

final class Item {
    private $id = NULL;
    private $name;
    private $status;
    private $changed;

    public function __construct($id)
    {
        $this->id = $id;
        $this->changed = false;
        echo 'Конструктор <br>';
        $this->init();
    }

    private function init()
    {
        if ($this->id != NULL)
        {
            $this->name = Objects::$name;
            $this->status = Objects::$status;
            echo 'Инициализировано <br>';
        }
        else {
            echo 'Уже было инициализировано<br>';
        }
    }

    public function __set($property, $value) 
    {
        if (property_exists($this, $property) & $property != 'id' & $value != NULL) {
                $this->$property = $value;
                $this->changed = true;
                echo ' Значение ' . $property . ' заменено на ' . $value . ' <br> ';
        }
        else{
            echo ' Ошибка доступа для __set, неверное свойство класса.<br>';
        }
    }

    public function __get($property) 
    {
        if (property_exists($this, $property)) {

            echo $this->$property . ' <br> ';
            return $this->$property;
        }
        echo ' Ошибка доступа для __get, неверное свойство класса.<br> ';
    }

    public function save()
    {
        if ($this->changed)
        {
            Objects::$name = $this->name;
            Objects::$status = $this->status;
            echo 'Данные сохранены в базу. <br>'; 
        }
        else {
            echo 'Изменений не было, данные не сохранены <br>'; 
        }
    }
}

$var = new Item(1);

$var->name;
$var->status;

$var->name = 'Igor';
$var->status = '2';
$var->id = 3;

$var->name;
$var->status;

$var->save();

echo Objects::$name . '<br>';
echo Objects::$status . '<br>';

?>