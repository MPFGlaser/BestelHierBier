<?php

namespace Controllers;

use Controllers\BaseController;
use Models\Beer;

class BeerController extends BaseController
{
    public function create(Beer $beer)
    {
        $data = array(
            'name' => $beer->name,
            'brewery' => $beer->brewery,
            'category' => $beer->category,
            'price' => $beer->price,
            'abv' => $beer->abv,
            'description' => $beer->description,
            'available' => $beer->available,
            'country' => $beer->country,
            'size' => $beer->size,
            'imageURL' => $beer->imageURL
        );
        $this->db->insert("beers", $data);
    }

    public function update(Beer $beer)
    {
        $data = array(
            'name' => $beer->getName(),
            'brewery' => $beer->getBrewery(),
            'category' => $beer->getCategory(),
            'price' => $beer->getPrice(),
            'abv' => $beer->getAbv(),
            'description' => $beer->getDescription(),
            'available' => $beer->getAvailable(),
            'country' => $beer->getCountry(),
            'size' => $beer->getSize(),
            'imageURL' => $beer->getImageURL()
        );
        $where = "id=" . $beer->getId();
        $this->db->update("beers", $data, $where);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM beers WHERE id = :id";
        $params = array('id' => $id);
        $result = $this->db->select($sql, $params);
        return new Beer($result[0]);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM beers";
        $result = $this->db->select($sql);

        $beers = array();
        foreach ($result as $item) {
            $beers[] = new Beer($item);
        }
        return $beers;
    }

    public function getByName($name)
    {
        $sql = "SELECT * FROM beers WHERE name = :name";
        $params = array('name' => $name);
        $result = $this->db->select($sql, $params);

        $beers = array();
        foreach ($result as $item) {
            $beers[] = new Beer($item);
        }
        return $beers;
    }

    public function getByNameOrBrewery($search)
    {
        $sql = "SELECT * FROM beers WHERE name LIKE :name OR brewery LIKE :brewery";
        $params = array(
            'name' => "%".$search."%",
            'brewery' => "%".$search."%"
        );
        $result = $this->db->select($sql, $params);

        $beers = array();
        foreach ($result as $item) {
            $beers[] = new Beer($item);
        }
        return $beers;
    }

    public function getByFilter($filterArray)
    {
        $filteredValues = implode(",", array_map(function ($string) {
            return '"' . $string . '"';
        }, $filterArray));
        $sql = "SELECT * FROM beers WHERE category IN ($filteredValues) OR brewery IN ($filteredValues)";
        $result = $this->db->select($sql);

        $beers = array();
        foreach ($result as $item) {
            $beers[] = new Beer($item);
        }
        return $beers;
    }

    public function getCategories()
    {
        $sql = "SELECT DISTINCT category FROM beers";
        $result = $this->db->select($sql);
        $categories = array();

        foreach ($result as $pair) {
            foreach ($pair as $value) {
                $categories[] = $value;
            }
        }
        return $categories;
    }

    public function getBreweries()
    {
        $sql = "SELECT DISTINCT brewery FROM beers";
        $result = $this->db->select($sql);
        $breweries = array();

        foreach ($result as $pair) {
            foreach ($pair as $value) {
                $breweries[] = $value;
            }
        }
        return $breweries;
    }
}
