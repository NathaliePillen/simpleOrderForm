<?php  
    //when the fields are not submit
    $email=$street=$streetnumber=$city=$zipcode="";   
    //associative array for the errors where at the beginning the value is empty 
    $errors = array('email' =>'', 'street'=>'', 'streetnumber'=>'', 'city' => '', 'zipcode'=>'');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             
        //validate email
        if(empty($_POST['email'])){
            $errors['email'] = 'email is required <br/>';
        } else {
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'email must be a valid address <br/>';
            }        
        }
    

        //validate street
        if(empty($_POST['street'])){
            $errors['street'] = 'street is required <br/>';
        } 
        else {
            $street = $_POST['street'];
            if (!preg_match('/^[a-zA-Z0-9\s\-]+$/', $street)){
                $errors['street'] = 'street must have valid characters. <br/>';
            }
        }


        //validate streetnumber
        if(empty($_POST['streetnumber'])){
            $errors['streetnumber'] = 'number is required <br/>';
        } 
        else {
            $streetnumber = $_POST['streetnumber'];
            if (!preg_match('/^[a-zA-Z0-9\s]+$/', $streetnumber)){
                $errors['streetnumber'] = 'number must have valid characters. <br/>';
            }
        }
        
        //validate city
        if(empty($_POST['city'])){
            $errors['city'] = 'city is required <br/>';
        } 
        else {
            $city = $_POST['city'];
            if (!preg_match('/^[a-zA-Z0-9\s\-]+$/', $city)){
                $errors['city'] = 'city must have valid characters. <br/>';
            }
        }

        
        //validate zipcode
        if(empty($_POST['zipcode'])){
            $errors['zipcode'] ='zipcode is required <br/>';
        } 
        else {
            $zipcode = $_POST['zipcode'];
            if (!is_numeric($zipcode)){
                $errors['zipcode'] = 'zipcode must have valid characters. <br/>';
            }
        }

        if(array_filter($errors)){
            //echo 'errors in form';
            echo '<div class="alert alert-primary" role="alert">';
            foreach ($errors as $error){
                echo $error;
                }
                echo '</div>';
		} else {
            echo '<div class="alert alert-primary" role="alert">' . 'Your order has been send' . '</div>';
        }

        if (isset($_POST["submit"])) {
            $_SESSION['email'] = htmlspecialchars($_POST['email']);
            $_SESSION['street'] = htmlspecialchars($_POST['street']);
            $_SESSION['streetnumber'] = htmlspecialchars($_POST['streetnumber']);
            $_SESSION['city'] = htmlspecialchars($_POST['city']);
            $_SESSION['zipcode'] = htmlspecialchars($_POST['zipcode']);
            }
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
                <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"  class="form-control">
                <div class="text-danger"><?php echo $errors['email']; ?></div>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" value="<?php echo htmlspecialchars($street); ?>" class="form-control" id="street" >
                    <div class="text-danger"><?php echo $errors['street']; ?></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" value=<?php echo htmlspecialchars($streetnumber); ?> >
                    <div class="text-danger"><?php echo $errors['streetnumber']; ?></div>         
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" class="form-control" name="city" value=<?php echo htmlspecialchars($city); ?> >
                    <div class="text-danger"><?php echo $errors['city']; ?></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" class="form-control" name="zipcode" value=<?php echo htmlspecialchars($zipcode); ?> >
                    <div class="text-danger"><?php echo $errors['zipcode']; ?></div>
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