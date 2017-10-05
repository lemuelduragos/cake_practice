<table class="table">
  <thead>
    <tr>
      <th>Name</th>
      <th>Description</th>
      <th>Price</th>
      <th><center>Quantity</center></th>
      <th>Total</th>
      <th>Action</th>
    </tr>
  <tbody>
  <?php 
  $grand_total = 0;
  foreach ($carts as $cart):?>
    <tr> 
      <td><?php echo $cart['product']['name']?></td>
      <td><?php echo $cart['product']['description']?></td>
      <td><?php echo $cart['product']['price']?></td>
      <td><center>
        <button class="btn btn-danger" href="#" id='minus<?php echo $cart['Cart']['id']?>' 
          onclick="clickMinus(<?php echo $cart['Cart']['id']?>,<?php echo $cart['product']['price']?>);">-
        </button>
        <input class='cartQuantity' id="quantity<?php echo $cart['Cart']['id']?>" value="<?php echo $cart['Cart']['quantity']?>" disabled/>
        <button class="btn btn-success" id="add<?php echo $cart['Cart']['id']?>" href="#" 
          onclick="clickAdd(<?php echo $cart['Cart']['id']?>,<?php echo $cart['product']['price']?>);">+
        </button>
        </center>
      </td>
      <td id="total<?php echo $cart['Cart']['id']?>"><?php echo $cart['Cart']['total']?></td>
      <?php $grand_total += $cart['Cart']['total']; ?>
      <td>
        <a class="btn btn-danger" href="#" onclick="removeClick(<?php echo $cart['Cart']['id']?>)">
        Remove</a>
      </td>
    </tr>
  <?php endforeach; ?> 
   </tbody> 
  </thead>
</table>
<div>
<h3>Grand Total: $<a id='grandtotal'><?php echo $grand_total; ?></a></h3>
<?php echo $this->html->link('Proceed to Checkout', array('action' => 'checkout'), array('class' => 'btn btn-warning btn-lg', 'id' => 'proceedToCheckout'));?>
</div>

<script>

    function removeClick(id) {
      angular.element($("[ng-controller='cartsController']")).scope().removeCart(id);
    }

    function clickAdd(id, price) {
      var price = parseInt(price);
      var unittotal =  parseInt(document.getElementById("total"+id).innerHTML); 
      var total =  parseInt(document.getElementById("grandtotal").innerHTML); 
      var quantity = parseInt(document.getElementById("quantity"+id).value);
      document.getElementById("quantity"+id).value  = quantity+1;
      document.getElementById("minus"+id).disabled = false;
      document.getElementById("grandtotal").innerHTML = total + price;
      document.getElementById("total"+id).innerHTML = unittotal + price;
        $.ajax({
            type: "POST",
            url: "http://localhost.com/cakeangular/carts/addQuantity",
            data:{id : id, quantity: quantity+1},
            success: function(response) {
            },
            error: function(response) {
            }
        });
    }

     function clickMinus(id, price) {
      var price = parseInt(price);
      var unittotal =  parseInt(document.getElementById("total"+id).innerHTML); 
      var total =  parseInt(document.getElementById("grandtotal").innerHTML); 
      var quantity = parseInt(document.getElementById("quantity"+id).value);
      if(1 < quantity) {
      document.getElementById("quantity"+id).value  = quantity-1;
      document.getElementById("grandtotal").innerHTML = total - price;
      document.getElementById("total"+id).innerHTML = unittotal - price;
       $.ajax({
            type: "POST",
            url: "http://localhost.com/cakeangular/carts/minusQuantity",
            data:{id : id, quantity: quantity-1},
            success: function(response) {
            },
            error: function(response) {
            }
        });

      }
      else {
        document.getElementById("minus"+id).disabled = true;
      }

    }
</script>


