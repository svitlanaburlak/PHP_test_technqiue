<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Cart</title>
	</head>
	<body>

    <?php
        use Domain\Aggregate\Cart;
        use Domain\VO\Coupon;

        require __DIR__ . "/Domain/Aggregate/Cart.php";
        require __DIR__ . "/Domain/VO/Coupon.php";
    ?>

    <form method="post">
			<fieldset>
				<label for="cart">Cart amount</label>
				<input type="number" name="cart" id="cart" value="">
			</fieldset>

			<fieldset>
				<label for="coupon">Your coupon discount</label>
				<input type="number" name="coupon" id="coupon" value="">
			</fieldset>

            <button> Your final cost is : </button>
                <?php
                if (isset($_POST["cart"])) 
                    {
                        $cart = new Cart();
                        $cart->setAmount(intval($_POST["cart"]));

                        if (isset($_POST["coupon"])) {
                            $coupon = new Coupon("coupon", intval($_POST["coupon"]), true, 0 );
                            // var_dump($coupon);
                            echo $cart->calculateCost($coupon);
                        }
                    };
                    
                ?>
            </p>
	</form>
    
    </body>
</html>