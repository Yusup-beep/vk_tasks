<?php

abstract class Animal {
    private string $name;
    private string $breed;
    private string $locale;
    private array $translations;


    function __construct($name, $breed = null, $locale = "en")
    {
        $this->name = $name;
        $this->breed = $breed ?? get_called_class();
        $this->locale = $locale;

        $localeFile = "./locales/" . $this->getLocale() . ".php";
        if (file_exists($localeFile)) {
            $this->translations = include $localeFile;
        } else {
            throw new Exception("Localization file not found for locale: " . $this->getLocale());
        }
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function getBreed(): string
    {
        return $this->translations[$this->breed] ?? $this->breed;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale($locale): void
    {
        $this->locale = $locale;
        $localeFile = "./locales/" . $locale . ".php";
        if (file_exists($localeFile)) {
            $this->locale = $locale;
            $this->translations = include $localeFile;
        } else {
            throw new Exception("Localization file not found for locale: " . $locale);
        }
    }

    public function sound(): string
    {
        return $this->translations[$this->getSound()] ?? $this->getSound();
    }
    abstract function getSound();
}

class Dog extends Animal
{
    function getSound(): string
    {
       return "Woof";
    }
}

class Cat extends Animal
{
    function getSound(): string
    {
        return "Meow";
    }
}

//$rex = new Dog("Rex", "Labrador");
//$stooped = new Dog("Stooped");
//$murka = new Cat("Murka");

//echo $rex->getBreed() . " " . $rex->getName() . " says " . $rex->sound() . "\n";
//echo $stooped->getBreed() . " " . $stooped->getName() . " says " . $stooped->sound() . "\n";
//echo $murka->getBreed() . " " . $murka->getName() . " says " . $murka->sound() . "\n";

// Результат работы программы
// Labrador Rex says Woof
// Dog Stooped says Woof
// Cat Murka says Meow