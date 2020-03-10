<div class="container col-md-6" ng-controller="userController">
  <div class="row">
    <div class="col-12">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Change Password</h3>
        </div>
        <div class="panel-body">
          <?php 
          if(isset($_SESSION['Message']['success'])){
              echo "<div class='alert alert-success col-lg-8'>". $this->Flash->render('success')."</div>";
          } else if(isset($_SESSION['Message']['error'])) {
               echo "<div class='alert alert-danger col-lg-8'>". $this->Flash->render('error')."</div>";
          }
          ?> 
          <div class="row">
            <div class="col-lg-8 ">
              <?php echo $this->Form->create('User', array('class' => 'user')); 
              $options = array('label' => 'Save Changes', 'class' => 'btn btn-primary btn-md float-right'); ?>
              <div class="form-group">
                <?php echo $this->Form->input('username',
                array('class' => 'form-control',
                'value' => $username));?>
              </div>
              <div class="form-group">
                <?php echo $this->Form->input('password',
                array('class' => 'form-control',
                'label' => 'Current Password'));?>
              </div>
              <div class="form-group">
                <?php echo $this->Form->input('new_password',
                array('class' => 'form-control', 'type' => 'password'));?>
              </div>
              <div class="form-group">
                <?php echo $this->Form->input('confirm_password',
                array('class' => 'form-control', 'type' => 'password'));?>
              </div>
                <?php echo $this->Form->end($options); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


      

           
         
         
         
         
            
