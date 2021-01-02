<?php

namespace Views;

use Controllers\BeerController;

class BeerCard
{
    public function show($id, $admin)
    {
        $beerController = new BeerController();
        $beer = $beerController->getById($id);
        $html =
        '<div class="product">'.
            '<div class="product-image">'.
                '<a href="/products/view.php?id='.$beer->getId().'"><img src=/images/'.$beer->getImageURL().' alt='.$beer->getName().'/> </a>'.
            '</div>'.
            '<div class="product-description">'.
                '<a href="/products/view.php?id='.$beer->getId().'">'.
                    '<div style="clear: both">'.
                        '<h1>'.$beer->getName().'</h1>'.
                        '<h2>('.$beer->getAbv().'%)</h2>'.
                    '</div>'.
                '</a><br>'.
                '<p>'.$beer->getCategory().' by '.$beer->getBrewery().'</p>'.
            '</div>'.
            '<div class="product-buttons">'.
                '<button onclick=window.location.href="/products/view.php?id='.$beer->getId().'">LEARN MORE</button>';

    if($admin){
        $html .= '<button onclick=window.location.href="/products/edit.php?id='.$beer->getId().'">EDIT</button>';
    }
$html .= '</div>'.
    '</div>';
    return $html;
    }
}
