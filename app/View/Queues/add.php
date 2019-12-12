<div class="container col-md-6" ng-controller="userController">
  <div class="row">
    <div class="col-12">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Request Priority Number</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <?php 
          if(isset($_SESSION['Message']['success'])){
              echo "<div class='alert alert-success col-lg-9'>". $this->Flash->render('success')."</div>";
          } else if(isset($_SESSION['Message']['error'])) {
               echo "<div class='alert alert-danger col-lg-9'>". $this->Flash->render('error')."</div>";
          }
          ?> 
            <div class=" col-md-9 col-lg-9 "> 
              <?php echo $this->Form->create('Queue', array('style' => 'width:100%')); 
                  $options = array('label' => 'Request',
                    'class' => 'btn btn-success btn-sm float-right',
                    'style' => 'width:20%'); ?>
                <div class="form-group">
                  <?php echo $this->Form->input('type', 
                    array('class' => 'form-control', 'type' => 'select', 'options' => $student_type, 'label' => 'Student type'))?>
                </div>
                <div class="form-group">
                  <?php echo $this->Form->input('name',
                    array('class' => 'form-control',
                      'label' => 'Name'));?>
                </div>
                <div class="form-group">
                  <?php echo $this->Form->input('id_number', 
                    array('class' => 'form-control', 'label' => "ID Number"));?>
                </div>
                 <div class="form-group">
                  <?php echo $this->Form->input('contact_number', 
                    array('class' => 'form-control'));?>
                </div>
                 <div class="form-group">
                  <?php echo $this->Form->input('office', 
                    array('class' => 'form-control', 'type' => 'select', 'options' => $office))?>
                </div>
                 <?php echo $this->Form->end($options); ?>
              </form>
          </div>
        </div>  
      </div>
    </div>
  </div>
</div>