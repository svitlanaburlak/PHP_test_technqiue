<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Cart</title>
	</head>
	<body>

    <?php
        use App\Domain\Aggregate\Cart;
        use App\Domain\VO\Coupon;

        require 'vendor/autoload.php';
        require __DIR__ . "/src/Domain/Aggregate/Cart.php";
        require __DIR__ . "/src/Domain/VO/Coupon.php";
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
                            $coupon = new Coupon(intval($_POST["coupon"]), true, 0 );
                            // var_dump($coupon);
                            echo $cart->calculateCost($coupon) . " with coupon #{$coupon->getCode()}";
                        }
                    };
                    
                ?>
            </p>
	</form>
    
    </body>
</html>