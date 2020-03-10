<div class="container col-md-6" ng-controller="userController">
<h3 class="panel-title">Add Graduate Student</h3>
  <div class="row">
    <div class="col-12">
      <div class="panel panel-info">
        <div class="panel-heading">
        
        </div>
        <div class="panel-body">
          <div class="row">
            <div class=" col-md-9 col-lg-9 "> 
              <?php echo $this->Form->create('Certificate', array('class' => 'user')); 
                  $options = array('label' => 'Add',
                    'class' => 'btn btn-primary btn-md float-right',
                    'style' => 'width:20%'); ?>
                <div class="form-group">
                  <?php echo $this->Form->input('reference',
                    array('class' => 'form-control',
                      'label' => 'Reference No.'));?>
                </div>
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
                  <?php echo $this->Form->input('issued_date', 
                    array('class' => 'form-control col-3 d-inline', 
                    'label' => 'Date Issued'));?>
                </div>
                <div class="form-group">
                  <?php echo $this->Form->input('assessment_date', 
                    array('class' => 'form-control col-3 d-inline'));?>
                </div>
                <div class="form-group">
                  <?php 
                    $select = array( 0=>'Not yet competent.', 1 => 'Competent');
                    echo $this->Form->input('assessment_result', array(
                        'type' => 'select',
                        'options' => $select,
                        'empty' => 'Select Result',
                        'id' => 'location',
                        'class' => 'form-control' ));
                    ?>
                </div>

                <div class="form-group">
                  <?php echo $this->Form->input('assessed_by',
                   array('class' => 'form-control',
                      'label' => 'Assessed By'));?>
                </div>

                <div class="form-group">
                  <?php echo $this->Form->input('attested_by',
                   array('class' => 'form-control',
                      'label' => 'Attested By'));?>
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