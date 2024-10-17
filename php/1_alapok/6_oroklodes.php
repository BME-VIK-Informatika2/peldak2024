<?php
require '../helpers.php';
/*
 * Öröklődés
 */

// Absztrakt szülőosztály
abstract class Car
{
    public string $brand = 'Generic';

    public abstract function drive(): void;
}

// Szülőosztály
class SportCar extends Car
{
    public string $type = 'Sport';

    public function drive(): void
    {
        echo "Vroom-vroom \n";
    }
}

// Gyermekosztály
class Ferrari extends SportCar
{
    public string $model = 'F8 Tributo';

    public function __construct()
    {
        $this->brand = 'Ferrari';
    }

    public function drive(): void
    {
        echo $this->brand . ' ' . $this->model . "\n";
        parent::drive();
    }
}

$sport = new SportCar();
println($sport);
$sport->drive();

$ferrari = new Ferrari();
println($ferrari);
$ferrari->drive();

// Többszörös leszármazás
trait Nameable
{
    public string $name = 'name';

    public function getName(): string
    {
        return $this->name;
    }
}

trait Addressable
{
    public string $address = 'address';

    public function getAddress(): string
    {
        return $this->address;
    }
}

class Person
{
    use Nameable, Addressable;
}

$p = new Person();
println($p->getName()); // name
println($p->getAddress()); // address

// Interfészek
interface ILogger
{
    public function log(string $message): void;
}

interface IFile
{
    public function write(string $message): void;
}

class FileLogger implements ILogger, IFile
{
    public function log(string $message): void
    {
        echo "Log: " . $message . "\n";
    }

    public function write(string $message): void
    {
        echo "Write to file: " . $message . "\n";
    }
}

$fileLogger = new FileLogger();
$fileLogger->log('log message'); // Log: log message
$fileLogger->write('file message'); // Write to file: file message