<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

//we are going to use session variables so we need to enable sessions
session_start();

function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
}



//your products with their price.
if (isset($_GET["food"]) && $_GET["food"] == 0) {
    $products = [
      ['name' => 'Cola', 'price' => 2],
      ['name' => 'Fanta', 'price' => 2],
      ['name' => 'Sprite', 'price' => 2],
      ['name' => 'Ice-tea', 'price' => 3],
    ];
  } else {
    $products = [
      ['name' => 'Club Ham', 'price' => 3.20],
      ['name' => 'Club Cheese', 'price' => 3],
      ['name' => 'Club Cheese & Ham', 'price' => 4],
      ['name' => 'Club Chicken', 'price' => 4],
      ['name' => 'Club Salmon', 'price' => 5]
    ];
  };
$totalValue = 0;
include 'formView.php';

/*var_dump($products);
foreach ($products as $element) {
  var_dump($element);
}
foreach ($products as $key => $value) {
  var_dump($key);
  var_dump($products[$key]);
  var_dump($products[$key]["price"]);
}*/

