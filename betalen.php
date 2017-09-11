<?php
// include database configuration file
include 'dbConfig.php';

// initializ shopping cart class
include 'Cart.php';
$cart = new Cart;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Orchids</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .container{padding: 50px;}
    input[type="number"]{width: 20%;}
    </style>
    <script>
    function updateCartItem(obj,id){
        $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
            if(data == 'ok'){
                location.reload();
            }else{
                alert('Cart update failed, please try again.');
            }
        });
    }
    </script>
</head>
<body>
<div class="container">
    <h1>Betaling</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($cart->total_items() > 0){
            //get cart items from session
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
        ?>
        <tr>
            <td><?php echo $item["name"]; ?></td>
            <td><?php echo '€ '.$item["price"]; ?></td>
            <td><?php echo $item["qty"]; ?></td>
            <td><?php echo '€ '.$item["subtotal"]; ?></td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="4"><p>Leeg winkelwagen......</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3"></td>
            <?php if($cart->total_items() > 0){ ?>
            <td class="text-center"><strong>Total <?php echo '€'.$cart->total(); ?></strong></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
    <div class="shipAddr">
    

            <?php if($cart->total_items() > 0){ ?>
            <td class="text-center"><strong>Totaal <?php echo '€ '.$cart->total(); ?> aan kosten</strong></td>

            <?php } ?>

<form action="" method="post">
<select name="payments" id="payments">
    <option value="Maestro">Maestro</option>
    <option value="Contant">Contant</option>
    <option value="Visa">Visa</option>
    <option value="Ideal">Ideal</option>
</select>
    <select name="deliveries" id="deliveries">
    <option value="ophalen">zelf ophalen</option>
    <option value="koerier">door een koerier laat brengen</option>
</select>
<input type="submit" value="Betalen" href="index.php?content=algemeneHomepage"/>
<input type="hidden" name="button_a" value="1" />
</form>
    
    </div>    
</div>
<?php

if(isset($_POST['button_a']))
{

$to      = ''; //can receive notification

$subject = 'Betaling';
$message = 'Wat leuk dat u artikelen uit ons assortiment heeft aangeschaft!'. "\r\n";
$message .= 'De totale kosten die u heeft betaald voor de artikelen zijn '.$cart->total().' euro'. "\r\n";
$message .= 'De artikelen heeft u betaald met '.$_POST['payments'].'.'."\r\n";
$message .= 'U heeft aangegeven dat u de artikelen '.$_POST['deliveries']. "\r\n";
$message .= "Met vriendelijke groet,". "\r\n";
$message .= "Sabrina Siemons". "\r\n";
$headers = 'From: no-reply@orchids.nl'."\r\n";
$headers .= 'Reply-To: info@orchids.nl'."\r\n";
$headers .= 'Cc: admin@orchids.nl'."\r\n";
$headers .= 'Bcc: accountant@orchids.nl'."\r\n";
//$headers = 'From: webmaster@orchids.com' . "\r\n" .
   // 'Reply-To: webmaster@orchids.com' . "\r\n" .
    //'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

}

?>

    
    
    </body>
</html>
    
