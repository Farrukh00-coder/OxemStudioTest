<?php

//Основной класс
abstract class Animal{
    // Статическая переменая для хранения id
    static $id = 1;
    // номер животного
    public $idAnimal=0;
    // количество произведенной продукции
    public abstract function getProduct();
    // возвращать
    public function getNameOfClass()
    {
        return static::class;
    }
}


//класс курица
class Chicken extends Animal{
    // коснтруктор
    function __construct() {
        // Задаем уникальный номер
        $this->idAnimal=parent::$id++;
    }
    // сколько может дать яиц курица
    public function getProduct(){
        return rand(0,1);
    }

}


//Класс корова
class Cow extends Animal{
    // коснтруктор
    function __construct() {
        // задаем номер уникальный
        $this->idAnimal=parent::$id++;
    }

    // сколько может дать корова молоко
    public function getProduct(){
        return rand(8, 12);
    }
}

//Создаем паттерн(Абстрактная фабрика) для животных
class ConcreteFactory
{
    // Регистриурем курицу
    public function createСhicken(): Chicken
    {
        return new Chicken;
    }
    // Регистрируем корову
    public function createCow(): Cow
    {
        return new Cow;
    }
}




// Абстрактная фабрика для регистрации животных
$factory = new ConcreteFactory();
// Хлев (где все животные )
$arrayAnimal = array();
// регистрируем 10 коров
for($i = 1; $i <= 10; $i++){
    $arrayAnimal[] = $factory->createCow();
}
// регистрируем 20 кур
for($i = 1; $i <= 20; $i++){
    $arrayAnimal[] = $factory->createСhicken();
}

// обнуляем корзину
$milk = 0;
$egg = 0;
// обходим и собераем продукцию
foreach ($arrayAnimal as $value){
    // в зависемости от животного слаживаем продукцию
    switch ($value->getNameOfClass()) {
        case "Cow":
            $milk += $value->getProduct();
            break;
        case "Chicken":
            $egg += $value->getProduct();
            break;
    }
}
echo "Молоко ".$milk." литров\n";
echo "Яйца ".$egg." шт.\n";