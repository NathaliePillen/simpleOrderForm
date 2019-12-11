<?php

    if (isset($_POST["submit"])) {
    $_SESSION['email'] = htmlspecialchars($_POST['email']);
    $_SESSION['street'] = htmlspecialchars($_POST['street']);
    $_SESSION['streetnumber'] = htmlspecialchars($_POST['streetnumber']);
    $_SESSION['city'] = htmlspecialchars($_POST['city']);
    $_SESSION['zipcode'] = htmlspecialchars($_POST['zipcode']);
    }
        
    $emailerror = $streeterror = $numbererror = $cityerror = $cityerror = $ziperror = $submiterror = "";
    $email = $street = $streetnumber = $city = $zipcode = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             
        //validate email
        echo '<div class="alert alert-primary" role="alert">';

        if(empty($_POST['email'])){
            $mailerror = 'email is required <br/>';
            echo $mailerror;
        } else {
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $mailerror = 'email must be a valid address <br/>';
                echo $mailerror;
            }        
        }
    

        //validate street
        if(empty($_POST['street'])){
            $streeterror= 'street is required <br/>';
            echo $streeterror;
        } 
        else {
            $street = $_POST['street'];
            if (!preg_match('/^[a-zA-Z0-9\s\-]+$/', $street)){
                $streeterror = 'street must have valid characters. <br/>';
                echo $streeterror;
            }
        }


        //validate streetnumber
        if(empty($_POST['streetnumber'])){
            $numbererror = 'number is required <br/>';
            echo $numbererror;
        } 
        else {
            $streetnumber = $_POST['streetnumber'];
            if (!preg_match('/^[a-zA-Z0-9\s]+$/', $streetnumber)){
                $numbererror = 'number must have valid characters. <br/>';
                echo $numbererror;
            }
        }
        
        //validate city
        if(empty($_POST['city'])){
            $cityerror = 'city is required <br/>';
            echo $cityerror;
        } 
        else {
            $city = $_POST['city'];
            if (!preg_match('/^[a-zA-Z0-9\s\-]+$/', $city)){
                $cityerror = 'city must have valid characters. <br/>';
                echo $cityerror;
            }
        }

        
        //validate zipcode
        if(empty($_POST['zipcode'])){
            $ziperror = 'zipcode is required <br/>';
            echo $ziperror;
        } 
        else {
            $zipcode = $_POST['zipcode'];
            if (!is_numeric($zipcode)){
                $ziperror = 'zipcode must have valid characters. <br/>';
                echo $ziperror;
            }
        }
        
        
        echo '</div>';
    }
   
        
?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <title>Order food & drinks</title>
</head>
<body>
<div class="container">
    <h1>Order food in restaurant "the Personal Ham Processors"</h1>
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>

<?php //echo $_SERVER["PHP_SELF"] ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" value="<?php if (!empty($_POST['email'])) {
                                                                            echo $_POST['email'];
                                                                            } elseif (!empty($_SESSION['email'])) {
                                                                            echo $_SESSION['email'];
                                                                            }
                                                                            ?>"  class="form-control">
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" value="<?php if (!empty($_POST['street'])) {
                                                                            echo $_POST['street'];
                                                                            } elseif (!empty($_SESSION['street'])) {
                                                                            echo $_SESSION['street'];
                                                                            }
                                                                            ?>"  class="form-control" id="street" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" value="<?php if (!empty($_POST['streetnumber'])) {
                                                                            echo $_POST['streetnumber'];
                                                                            } elseif (!empty($_SESSION['streetnumber'])) {
                                                                            echo $_SESSION['streetnumber'];
                                                                            }
                                                                            ?>" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" value="<?php if (!empty($_POST['city'])) {
                                                                            echo $_POST['city'];
                                                                            } elseif (!empty($_SESSION['city'])) {
                                                                            echo $_SESSION['city'];
                                                                            }
                                                                            ?>" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" value="<?php if (!empty($_POST['zipcode'])) {
                                                                            echo $_POST['zipcode'];
                                                                            } elseif (!empty($_SESSION['zipcode'])) {
                                                                            echo $_SESSION['zipcode'];
                                                                            }
                                                                            ?>" class="form-control">
                </div>
            </div>
        </fieldset>

        <fieldset>
          <legend>Products</legend>
          <?php
            foreach ($products as $i => $product) : ?>
            <label>
              <input type="checkbox" value="1" name="products[<?php echo $i ?>]" /> <?php echo $product['name'] ?> -
              &euro; <?php echo number_format($product['price'], 2) ?></label><br />
          <?php endforeach; ?>
        </fieldset>            
      

        <button type="submit" name="submit" value="submit" class="btn btn-primary">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in food and drinks.</footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>