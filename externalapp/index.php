<?php

?>

<html lang="en">
<head>
    <title>External app</title>
    <script src="jquery-3.3.1.js"></script>
    <script src="placeorder.js"></script>

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-8">
            <h3>It is time to communicate with the exposed API, we need the API Key passed in header</h3>
            <hr>
            <h4>Feature 1. Placing an order</h4>
            <hr>
            <form name="order_form" id="order_form" method="post" action="<? $_SERVER['PHP_SELF'] ?>">
                <fieldset>
                    <legend>Place order</legend>

                    <input type="text" name="name_of_food" id="name_of_food" required placeholder="Name of food"><br>
                    <input type="number" name="number_of_units" id="number_of_units" required placeholder="Number of units"><br>
                    <input type="number" name="unit_price" id="unit_price" required placeholder="unit price"><br>
                    <input type="text" name="status" id="status" required placeholder="Order placed"><br><br>
                   
                    <button class="btn btn-primary" type="submit" id="place-order-btn">Place order</button>
                </fieldset>
            </form>
            <hr>
            <form name="order_status_form" id="order_status_form" method="post" action="<? $_SERVER['PHP_SELF'] ?>">
                <h4>Feature 2 - Checking order status</h4>
                <fieldset>
                    <legend>Check order status</legend>
                    <input type="number" name="order_id" id="order_id" required placeholder="Order ID">
                    <br><br>
                    <button class="btn btn-warning" type="submit" id="check-order-btn">Check order status</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>

</body>
</html>
