<?php

namespace Models;

class Beer
{
    protected $id;
    protected $name;
    protected $brewery;
    protected $category;
    protected $price;
    protected $abv;
    protected $description;
    protected $available;
    protected $country;
    protected $size;
    protected $imageURL;

    public function __construct($beer)
    {
        $this->id = $beer['id'];
        $this->name = $beer['name'];
        $this->brewery = $beer['brewery'];
        $this->category = $beer['category'];
        $this->price = $beer['price'];
        $this->abv = $beer['abv'];
        $this->description = $beer['description'];
        $this->available = $beer['available'];
        $this->country = $beer['country'];
        $this->size = $beer['size'];
        $this->imageURL = $beer['imageURL'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getBrewery()
    {
        return $this->brewery;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getAbv()
    {
        return $this->abv;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getAvailable()
    {
        return $this->available;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getImageURL()
    {
        return $this->imageURL;
    }
}
