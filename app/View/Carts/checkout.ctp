<div class="container col-md-6" ng-controller="userController" style="margin-bottom: 100px">
  <div class="row">
    <div class="col-12">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Checkout</h3>
        </div>
        <div class="panel-body" src>
          <div class="row">
          <div class="alert alert-success col-md-12"><center>
          <div class="col-md-12">
          <table class="table borderless" >
            <thead>
              <tr >
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th><center>Quantity</center></th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $grand_total = 0;
              foreach ($carts as $cart):?>
              <tr> 
                <td><?php echo $cart['product']['name']?></td>
                <td><?php echo $cart['product']['description']?></td>
                <td><?php echo $cart['product']['price']?></td>
                <td><center><?php echo $cart['Cart']['quantity']?></center></td>
                <td id="total<?php echo $cart['Cart']['id']?>"><?php echo $cart['Cart']['total']?></td>
                <?php $grand_total += $cart['Cart']['total']; ?>
              </tr>
              <?php endforeach; ?> 
            </tbody> 
          </table>
          <div class="alert alert-warning">
            <h3>Grand Total: $<a id='grandtotal'><?php echo $grand_total; ?></a></h3>
          </div>
         </center>
          </div>
          </div>
          <div class="row">
            <div class=" col-md-12 col-lg-12 alert alert-default"> 
              <?php echo $this->Form->create('User', array('type' => 'file', 'style' => 'width:100%')); 
                  $options = array('label' => 'Proceed ➤',
                    'class' => 'btn btn-warning btn-lg float-right',
                    'style' => array('width:20%','overflow-wrap: break-word')); ?>
                <div class="form-group">
                  <?php echo $this->Form->input('first_name',
                    array('class' => 'form-control',
                      'label' => 'Name',
                      'value' => '{{user.0.User.first_name}} {{user.0.User.middle_name}} {{user.0.User.last_name}}'));?>
                </div>
                <div class="form-group">
                  <?php echo $this->Form->input('contact_number', 
                    array('class' => 'form-control',
                    'value' => ''));?>
                </div>
                <div class="form-group">
                  <?php echo $this->Form->input('email_address', 
                    array('class' => 'form-control',
                    'value' => '{{user.0.User.email_address}}'));?>
                </div>
                <div class="form-group">
                  <input type="radio" name="address" id='r1' checked="checked"> Current Shipping Address<b id="shppingString"> {{user.0.User.shipping_address}} {{user.0.User.city}} {{user.0.User.zip_code}}</b><br>
                  <input type="radio" name="address" id='r2'> Input Shipping Address
                </div>
                <div id='shipping_address' style="display: none">
                <div class="form-group">
                  <?php echo $this->Form->input('shipping_address', 
                    array('class' => 'form-control',
                    'value' => '{{user.0.User.shipping_address}}'));?>
                </div>
                <div class="form-group">
                  <?php echo $this->Form->input('city', 
                    array('class' => 'form-control',
                    'value' => '{{user.0.User.city}}'));?>
                </div>
                <div class="form-group">
                  <?php echo $this->Form->input('zip_code', 
                    array('class' => 'form-control',
                    'value' => '{{user.0.User.zip_code}}'));?>
                </div>
                </div>
                 <?php echo $this->Form->end($options); ?>
              </form>
          </div>
        </div>  
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#r1').on('click', function()
  {
    $('#shipping_address').toggle('slow');
    $('#shppingString').toggle();
  });
  $('#r2').on('click', function()
  {
    $('#shipping_address').toggle('slow');
    $('#shppingString').toggle();
  });
</script>
