<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //validate email
        if(empty($_POST['email'])){
            echo 'email is required <br/>';
        } else {
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo 'email must be a valid address <br/>';
            }        
        }

        //validate street
        if(empty($_POST['street'])){
            echo 'street is required <br/>';
        } 
        
        /*else {
            $street = $_POST['street'];
            if (!preg_match('/^[a-zA-Z0-9\s\-]+$/', $street)){
                echo 'street must have valid characters. <br/>';
            }
        }*/


        //validate streetnumber
        if(empty($_POST['streetnumber'])){
            echo 'number is required <br/>';
        } 
        /*else {
            $streetnumber = $_POST['streetnumber'];
            if (!preg_match('/^[a-zA-Z0-9\s]+$/', $streetnumber)){
                echo 'number must have valid characters. <br/>';
            }
        }*/

        //validate city
        if(empty($_POST['city'])){
            echo 'city is required <br/>';
        } 
        /*else {
            $city = $_POST['city'];
            if (!preg_match('/^[a-zA-Z0-9\s\-]+$/', $city)){
                echo 'city must have valid characters. <br/>';
            }
        }*/


        //validate zipcode
        if(empty($_POST['zipcode'])){
            echo 'zipcode is required <br/>';
        } 
        /*else {
            $zipcode = $_POST['zipcode'];
            if (!preg_match('/^[a-zA-Z0-9\s]+$/', $zipcode)){
                echo 'zipcode must have valid characters. <br/>';
            }
        }*/
    }
        //validate checkbox
       
        
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
                <input type="text" id="email" name="email" class="form-control"/>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control">
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>

            <?php                
            
           switch ($_SERVER['REQUEST_URI']){
            case '/orderForm/?food=0':
                foreach ($drinks as $product) {
                    //echo 'for each drinks';
                    echo '<label>';
                    echo "<input type='checkbox' value='1' name='product'/> ";
                    echo $product['name'];
                    echo '- &euro; ';
                    echo number_format($product['price'], 2) . '</label><br />'; 
                    //echo 'line 154';
                }
                break;

            default :
                foreach ($food as $product) {
                    //echo 'if food statement';
                    echo '<label>';
                    echo "<input type='checkbox' value='1' name='product'/> ";
                    echo $product['name'];
                    echo '- &euro; ';
                    echo number_format($product['price'], 2) . '</label><br />';
                }
                break;
            }

            /*
            if ($_SERVER['REQUEST_URI']=="/OrderForm/?food=0"){
                foreach ($drinks['products'] as $i => $product) {
                    echo 'first loop';
                    echo '<label>';
                    echo "<input type='checkbox' value='1' name='products[$i]'/> ";
                    echo $product['name'];
                    echo '- &euro; ';
                    echo number_format($product['price'], 2) . '</label><br />'; 
                    echo 'line 154';
                }
           }
            else { echo "line156";
                foreach ($food['products'] as $i => $product) {
                    echo "line158";
                    echo '<label>';
                    echo "<input type='checkbox' value='1' name='products[$i]'/> ";
                    echo $product['name'];
                    echo '- &euro; ';
                    echo number_format($product['price'], 2) . '</label><br />';
                }
            }*/
            ?>

        </fieldset>

        <button type="submit" class="btn btn-primary">Order!</button>
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