<?php

// Edits the product corresponding to the given id in the database with the given values.
function editProduct($id, $name, $brewery, $category, $price, $abv, $description, $available, $country, $size, $imageURL)
{
    include('../php/opendb.php');
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE beers SET name=?, brewery=?, category=?, price=?, abv=?, description=?, available=?, country=?, size=?, imageURL=? WHERE id=?";
        $sqlSent = $db->prepare($sql);
        if ($sqlSent->execute([$name, $brewery, $category, $price, $abv, $description, $available, $country, $size, $imageURL, $id])) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $ex) {
        die("Error: " . $ex->getMessage());
    }
}

// Adds a new product to the database with the given parameters.
function newProduct($name, $brewery, $category, $price, $abv, $description, $available, $country, $size, $imageURL)
{
    include('../php/opendb.php');
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO beers (name, brewery, category, price, abv, description, available, country, size, imageURL) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sqlSent = $db->prepare($sql);
        if ($sqlSent->execute([$name, $brewery, $category, $price, $abv, $description, $available, $country, $size, $imageURL])) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $ex) {
        die("Error: " . $ex->getMessage());
    }
}

// Returns a beer object with data corresponding to that of the entry with the given ID in the database.
function getProduct($id): Beer
{
    include_once('../php/classes/beerClass.php');
    include('../php/opendb.php');

    $beer = null;
    $name = null;
    $brewery = null;
    $category = null;
    $price = null;
    $abv = null;
    $description = null;
    $available = null;
    $country = null;
    $size = null;
    $imageURL = null;

    if ($id == 0) {
        $beer = new Beer(null, null, null, null, null, null, null, null, null, null, null);
    } else {
        try {
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM beers WHERE id = '" . $id . "'";
            $sqlSent = $db->prepare($sql);
            $sqlSent->execute();
            $beer = $sqlSent->fetch(PDO::FETCH_ASSOC);

            if (isset($beer['id'])) {
                $name = $beer['name'];
                $brewery = $beer['brewery'];
                $category = $beer['category'];
                $price = $beer['price'];
                $abv = $beer['abv'];
                $description = $beer['description'];
                $available = $beer['available'];
                $country = $beer['country'];
                $size = $beer['size'];
                $imageURL = $beer['imageURL'];

                $beer = new Beer($id, $name, $brewery, $category, $price, $abv, $description, $available, $country, $size, $imageURL);
            } else {
                // Redirects to index if the beer does not exist in the database and the ID isn't 0 (editing)
                header("Location: /index.php");
            }
        } catch (PDOException $ex) {
            die("Error: " . $ex->getMessage());
        }
    }

    return $beer;
}

// Returns an array with all products found in the database.
function getAllProducts()
{
    include('php/opendb.php');
    $beers = null;
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM beers";
        $sqlSent = $db->prepare($sql);
        $sqlSent->execute();
        $beers = $sqlSent->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
        die("Error: " . $ex->getMessage());
    }
    return $beers;
}

function getProductByName($searchString){
    include('opendb.php');
    $beers = null;
    $searchParam = '%'.$searchString.'%';
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM beers WHERE name LIKE ? OR brewery LIKE ?";
        $sqlSent = $db->prepare($sql);
        $sqlSent->execute([$searchParam, $searchParam]);
        $beers = $sqlSent->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
        die("Error: " . $ex->getMessage());
    }
    return $beers;
}

// Returns an array of all unique categories, sorted alphabetically.
function getCategories()
{
    include('php/opendb.php');
    $categories = null;
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT DISTINCT category FROM beers";
        $sqlSent = $db->prepare($sql);
        $sqlSent->execute();
        $categories = $sqlSent->fetchAll(PDO::FETCH_COLUMN);
        sort($categories);
    } catch (PDOException $ex) {
        die("Error: " . $ex->getMessage());
    }
    return $categories;
}

// Returns an array of all unique breweries, sorted alphabetically.
function getBreweries()
{
    include('php/opendb.php');
    $breweries = null;
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT DISTINCT brewery FROM beers";
        $sqlSent = $db->prepare($sql);
        $sqlSent->execute();
        $breweries = $sqlSent->fetchAll(PDO::FETCH_COLUMN);
        sort($breweries);
    } catch (PDOException $ex) {
        die("Error: " . $ex->getMessage());
    }
    return $breweries;
}
