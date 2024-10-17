<?php
require '../helpers.php';
/*
 * Objektumok
 */

// Létrehozás tömbből
$var = ['name' => 'Béla', 'age' => 30];
$obj = (object)$var;
println($obj->name); // Béla
println($obj->age); // 30

// Új stdClass példány
$obj = new stdClass();
$obj->name = 'Ferenc';
$obj->age = 31;
println($obj); // {name => Ferenc, age => 31}

// Saját osztálydefiníció
class Person{
    // Property-k
    public string $name;
    public int $age;

    // Konstruktor és destruktor
    public function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
        $this->greet();
    }

    public function __destruct()
    {
        echo "Goodbye $this->name!\n";
    }

    // Publikus metódusok
    public function setName(string $name):void{
        $this->name = $name;
    }

    public function __toString(): string
    {
        return "Person {name => $this->name, age => $this->age}";
    }

    // Privát metódus
    private function greet(): void
    {
        echo "Hello $this->name!\n";
    }
}

$p = new Person("Béla", 30); // Hello Béla!
println($p); // Person {name => Béla, age => 30}
$p->setName("István");
println($p->name); // István

// Saját destruktor hívása, ha nem hívjuk meg, a script futásának végén hívódik meg
unset($p); // Goodbye István!
$p = new Person("Ferenc", 31); // Hello Ferenc!
// A destruktor meghívódik a script végén


// Statikus változók és metódusok
class Counter{
    public static int $count = 0;
    public static function reset()
    {
        self::$count = 0;
    }
}

// Statikus változó elérhető az osztályon vagy objektumon keresztül is
println(Counter::$count); // 0

$c1 = new Counter();
println($c1::$count); // 0

// Statikus változó módosítása
$c1::$count++;
println($c1::$count); // 1
$c2 = new Counter();
println($c2::$count); // 1

// Statikus metódus hívása
Counter::reset();
$c2::reset();
println($c1::$count); // 0

// Konstansok
class Math{
    const PI = 3.14159;

    public static function areaOfCircle(float $r): float
    {
        return self::PI * $r * $r;
    }
}

println(Math::PI); // 3.14159
println(Math::areaOfCircle(5)); // 78.53975

