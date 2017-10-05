<div class="container col-md-6" ng-controller="userController" style="margin-bottom: 100px">
  <div class="row">
    <div class="col-12">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Edit Profile</h3>
        </div>
        <div class="panel-body" src>
          <div class="row">
          <div class="alert alert-success col-md-12"><center>
          <div class="col-md-12">
          <img ng-src="../{{user.0.User.photo}}" class="img-rounded" alt="Profile Picture" width="200px" height="200px" style="text-align: center; margin-top:30px" /><h1>{{user.0.User.first_name}} {{user.0.User.middle_name}} {{user.0.User.last_name}}</h1></center>
          </div>
          </div>
          <div class="row">
            <div class=" col-md-12 col-lg-12 alert alert-default"> 
              <?php echo $this->Form->create('User', array('type' => 'file', 'style' => 'width:100%')); 
                  $options = array('label' => 'Save Changes',
                    'class' => 'btn btn-success btn-sm float-right',
                    'style' => array('width:20%','overflow-wrap: break-word')); ?>
                <div class="form-group">
                  <div class="alert alert-info">Upload Photo
                  <?php echo $this->Form->input('photo', 
                    array( 'label' => '',
                    'type' => 'file', 'required' => false));?></div>
                  <div class="alert alert-warning">Note: Uploading another photo will delete your current profile picture.</div>
                </div>
                <div class="form-group">
                  <?php echo $this->Form->input('first_name',
                    array('class' => 'form-control',
                      'label' => 'Firstname',
                      'value' => '{{user.0.User.first_name}}'));?>
                </div>
                <div class="form-group">
                  <?php echo $this->Form->input('middle_name',
                   array('class' => 'form-control',
                      'label' => 'Middlename',
                      'value' => '{{user.0.User.middle_name}}'));?>
                </div>
                <div class="form-group">
                  <?php echo $this->Form->input('last_name',
                    array('class' => 'form-control',
                      'label' => 'Lastname',
                      'value' => '{{user.0.User.last_name}}'));?>
                </div>
                <div class="form-group">
                  <?php echo $this->Form->input('email_address', 
                    array('class' => 'form-control',
                    'value' => '{{user.0.User.email_address}}'));?>
                </div>
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
                 <?php echo $this->Form->end($options); ?>
              </form>
          </div>
        </div>  
      </div>
    </div>
  </div>
</div>

