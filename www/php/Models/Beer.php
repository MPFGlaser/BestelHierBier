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
}
