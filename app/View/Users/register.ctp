<div class="container col-md-6" ng-controller="userController">
<h3 class="panel-title">Registration Form</h3>
  <div class="row">
    <div class="col-12">
      <div class="panel panel-info">
        <div class="panel-heading">
        
        </div>
        <div class="panel-body">
          <div class="row">
            <div class=" col-md-9 col-lg-9 "> 
              
              <?php 
                if(isset($_SESSION['Message']['success'])){
                    echo "<div class='alert alert-success'>". $this->Flash->render('success')."</div>";
                } else if(isset($_SESSION['Message']['error'])) {
                     echo "<div class='alert alert-danger'>". $this->Flash->render('error')."</div>";
                }

                echo $this->Form->create('User', array('class' => 'user')); 
                  $options = array('label' => 'Register',
                    'class' => 'btn btn-success btn-md float-right',
                    'style' => 'width:20%'); ?>
                <div class="form-group">
                  <?php echo $this->Form->input('first_name',
                    array('class' => 'form-control',
                      'label' => 'Firstname'));?>
                </div>
                <div class="form-group">
                  <?php echo $this->Form->input('middle_name',
                   array('class' => 'form-control',
                      'label' => 'Middlename'));?>
                </div>
                <div class="form-group">
                  <?php echo $this->Form->input('last_name',
                    array('class' => 'form-control',
                      'label' => 'Lastname'));?>
                </div>
                <div class="form-group">
                  <?php echo $this->Form->input('email_address', 
                    array('class' => 'form-control'));?>
                </div>
                <div class="form-group">
                  <?php echo $this->Form->input('username', 
                    array('class' => 'form-control'));?>
                </div>
                <div class="form-group">
                  <?php echo $this->Form->input('password', 
                    array('class' => 'form-control'));?>
                </div>
                <div class="form-group">
                  <?php echo $this->Form->input('confirm_password', 
                    array('class' => 'form-control', 'type' => 'password'))?>
                </div>
                 <div class="form-group">
                  <?php echo $this->Form->input('role', 
                    array('class' => 'form-control', 'type' => 'select'))?>
                </div>
                 <?php echo $this->Form->end($options); ?>
              </form>
              <br><br><br><br>
          </div>
        </div>  
      </div>
    </div>
  </div>
</div>