<?php

class Objects{
    /**
     * 
     * Данные из базы
     * @name string Имя
     * @status int Статус
     * 
     */

    public static $name = 'Alex';
    public static $status = 1;
}

final class Item {
    /**
     * 
     * @id int Идендификатор 
     * @name string Имя item 
     * @status int Стастус item
     * @changed bool Определение изменения данных name и статус
     * 
     */

    private $id = NULL;
    private $name;
    private $status;
    private $changed;

     /**
     * 
     * Конструктор проверяет id на принадлежность к типу int
     * Потом присваивает свойствам класса Item значения id и changed
     * @param int $id индендификатор
     * 
     */
    public function __construct($id)
    {
        if(!is_int($id))
        {
            die("Id not int");
        }
        
        $this->id = $id;
        $this->changed = false;
        echo 'Конструктор <br>';
        $this->init();
    }

    /**
         * 
         * Функция инициализации получения данных из базы
         * 
         */
    private function init()
    {
        try {
            if ($this->id !== NULL)
            {
                if(!is_string(Objects::$name) || !is_int(Objects::$status))
                {
                    die("Wrong object");
                }
                $this->name = Objects::$name;
                $this->status = Objects::$status;
                echo 'Инициализировано <br>';
            }
            else{
                throw new Exception ('Уже было инициализировано');
            }
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * 
     * Установка нового значения для name или status
     * @param string $property, Свойство класса Item кроме Id
     * @param int,string $value, Значение
     * 
     */
    
    public function __set($property, $value) 
    {
        try {
            if (property_exists($this, $property) & $property !== 'id' & $value !== NULL) {
                $this->$property = $value;
                $this->changed = true;
                echo ' Значение ' . $property . ' заменено на ' . $value . ' <br> ';
            }
            else{
                throw new Exception ('Ошибка доступа для __set, неверное свойство класса.');
            }
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * 
     * Получения свойства класса name или status
     * @param string $property свойства класа кроме id
     * 
     */

    public function __get($property) 
    {
        try {
            if (property_exists($this, $property)) {

                echo $this->$property . ' <br> ';
                return $this->$property;
            }
            else{
                throw new Exception ('Ошибка доступа для __get, неверное свойство класса.');
            }
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * 
     * Сохранение даных в базу
     * 
     */

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

/**
 * 
 * Для проверки
 * 
 */

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
