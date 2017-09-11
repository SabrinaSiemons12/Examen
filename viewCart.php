<?php
// initializ shopping cart class
 require_once("./classes/SpeciaalClass.php");
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
    <h1>Winkelwagen</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Prijs</th>
            <th>Aantal</th>
            <th>Totaal</th>
            <th>&nbsp;</th>
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
            <td><?php echo '€'.$item["price"]; ?></td>
            <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
            <td><?php echo '€'.$item["subtotal"]; ?></td>
            <td>
                <a href="cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>" class="btn btn-danger" onclick="return confirm('Weet je het zeker?')"><i class="glyphicon glyphicon-trash"></i></a>
            </td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="5"><p>Je winkelwagen is leeg.....</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td><a href="index.php?content=winkel" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Doorgaan met winkelen</a></td>
            <td>
          
            
            <td colspan="2"></td>
            <?php if($cart->total_items() > 0){ ?>
            <td class="text-center"><strong>Total <?php echo '€'.$cart->total(); ?></strong></td>
            <td><a href="index.php?content=checkout" class="btn btn-success btn-block" value="submit">Betalen <i class="glyphicon glyphicon-menu-right"></i></a></td>
            <?php } ?>
      
        </tr>
    </tfoot>
    </table>
</div>
</body>
</html>