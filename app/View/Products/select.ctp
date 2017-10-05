<table class="table table-hover">
  <thead>
    <tr>
      <th>Name</th>
      <th>Description</th>
      <th>Price</th>
      <th>Stocks</th>
      <th>Input Quantity</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody> 
  <?php foreach ($products as $product):?>
    <tr>
      <td><?php echo $product['Product']['name']?></td>
      <td><?php echo $product['Product']['description']?></td>
      <td><?php echo $product['Product']['price']?></td>
      <td><?php echo $product['Product']['stock']?></td>
      <td>
       <input value="1"/ class="quantity" id="quantity<?php echo $product['Product']['id']?>">
      </td>
      <td>
        <!-- <a class="btn btn-success add_to_cart" href="#" id='addCart' ng-click="addToCart()"> -->
        <a class="btn btn-success" href="#" onclick="addToCartClick(<?php echo $product['Product']['id']?>,<?php echo $product['Product']['id']?>);">
        Add to Cart</a>
      </td>
    </tr>
  <?php endforeach; ?> 
  </tbody> 
</table>
<?php 
// echo $this->Html->script('ajax');
 ?>
<script>

    function addToCartClick(id) {
      var quantity = $('#quantity'+id).val();
      angular.element($("[ng-controller='globalController']")).scope().addToCart(id, quantity);
    }

</script>