<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <title>Order food & drinks</title>
</head>

<body>
    <div class="container">
        <h1>Order food in restaurant "the Personal Ham Processors"</h1>
        <nav>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="?menu=0">Order food</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?menu=1">Order drinks</a>
                </li>
            </ul>
        </nav>

        <?php

        ?>

        <?php // I MAKE ALL FIELDS FOR THE ADDRESS REQUIRED BY MAKING THESE EMPRTY STRING VARIABLES 
        $emailErr = $streetErr = $streetNumberErr = $cityErr = $zipcodeErr = "";
        $email = $street = $streetNumber = $city = $zipcode = "";        

        $isFormValid = true;


        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $email = ($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "A valid email is required";
                $isFormValid = false;
            }

            $street = ($_POST["street"]);
            if (empty($street)) {
                $streetErr = "Street is required";
                $isFormValid = false;
            }

            $streetNumber = ($_POST["streetnumber"]);
            if(empty($streetNumber)) {
                $streetNumberErr = "Street number is required";
                $isFormValid = false;
            }
            else if(!filter_var($streetNumber, FILTER_VALIDATE_INT)) {
                $streetNumberErr = "Street number must be numerical";
                $isFormValid = false;
            }

            $city = ($_POST["city"]);
            if (empty($city)) {
                $cityErr = "City is required";
                $isFormValid = false;
            }

            $zipcode = ($_POST["zipcode"]);
            if(empty($zipcode)) {
                $zipcodeErr = "Zipcode is required";
                $isFormValid = false;
            }
            else if(!filter_var($zipcode, FILTER_VALIDATE_INT)) {
                $zipcodeErr = "Zipcode must be numerical";
                $isFormValid = false;
            }
        }
        ?> 

        <?php

            if($_SERVER["REQUEST_METHOD"] == "POST") {
                if($isFormValid) {
                    ?> <h1 style="color:green">Your order was recorded!</h1> <?php
                } else {
                    ?> <h1 style="color:red">Your order was shit!</h1> <?php
                }
            }            
        ?>

        <form method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">E-mail:</label>
                    <input type="text" id="email" name="email" class="form-control" value="<?php echo $email ?>" />
                    <?php echo $emailErr; ?></span>
                        <br><br>
                </div>
                <div></div>
            </div>

            <fieldset>
                <legend>Address</legend>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="street">Street:</label>
                        <input type="text" name="street" id="street" class="form-control" value="<?php echo $street ?>">
                        <span class="error"> <?php echo $streetErr; ?></span>
                        <br><br>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="streetnumber">Street number:</label>
                        <input type="text" id="streetnumber" name="streetnumber" class="form-control" value="<?php echo $streetNumber ?>">
                        <span class="error"> <?php echo $streetNumberErr; ?></span>
                        <br><br>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" class="form-control" value="<?php echo $city ?>">
                        <?php echo $cityErr; ?></span>
                        <br><br>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="zipcode">Zipcode</label>
                        <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?php echo $zipcode ?>">
                        <?php echo $zipcodeErr; ?></span>
                        <br><br>
                    </div>
                </div>
            </fieldset>
            <button type="submit" class="btn btn-primary">Order!</button>
            <br>


            <fieldset>
                <legend>Products</legend>




                <?php                      
                    
                    $menu = 0;                    
                    $products;

                    if(isset($_GET["menu"])) {
                        $menu = $_GET["menu"];
                    }

                    if($menu == 0) {
                        $products = $foodProducts;
                    }
                    else if($menu == 1) {
                        $products = $drinkProducts;
                    }

                    foreach ($products as $i => $product) : ?>
                        <label>
                            <input type="checkbox" value="1" name="products[<?php echo $i ?>]" /> <?php echo $product['name'] ?> -
                            &euro; <?php echo number_format($product['price'], 2) ?>
                        </label>
                        <br />
                    <?php endforeach; 
                ?>



            </fieldset>


        </form>

        <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in food and drinks.</footer>
    </div>

    <?php whatIsHappening(); ?>

    <style>
        footer {
            text-align: center;
        }
    </style>
</body>

</html>