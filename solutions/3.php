<?php

require_once('./2.php');

class ConfigReader {
    public const string LOCALE_RU = 'ru';
    public const string LOCALE_EN = 'en';
}

class Controller {
    private string $locale;
    
    public function __construct($locale = "en")
    {
        $this->locale = $locale;
    }

    public function index(): void
    {
        $rex = new Dog('Rex', 'Labrador');
        $murka = new Cat('Мурка');

        $this->showLine($rex);
        $this->showLine($murka);
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function showLine(Animal $animal): void
    {
        $animal->setLocale($this->getLocale());
        $translations = include "./locales/" . $this->getLocale() . ".php";
        echo $animal->getBreed() . " " . $animal->getName() . " " . $translations["says"] . " " . $animal->sound() . "\n";
    }
}

$controller = new Controller(ConfigReader::LOCALE_RU);
$controller->index();
$controller_en = new Controller(ConfigReader::LOCALE_EN);
$controller_en->index();

// Ожидаемый результат работы программы
// Лабрадор Rex говорит Гав
// Кошка Мурка говорит Мяу
// Labrador Rex says Woof
// Cat Мурка says Meow
