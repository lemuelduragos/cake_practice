
<div class="card shadow mb-4">
  <div class="card-header py-5 p-3">
    <center>
      <h1>Certification Request Form</h1>
    <?php 
    if(isset($_SESSION['Message']['success'])){
        echo "<div class='alert alert-success'>". $this->Flash->render('success')."</div>";
    } else if(isset($_SESSION['Message']['error'])) {
        echo "<div class='alert alert-danger'>". $this->Flash->render('error')."</div>";
    }

    echo $this->Form->create('Certificate', array('class' => 'user col-6')); 
      $options = array('label' => 'Submit',
        'class' => 'btn btn-success btn-md float-right'); ?>
  
    <div class="form-group">
      <?php echo $this->Form->input('first_name',
        array('class' => 'form-control', 'required' => 'required',
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
          'required' => 'required',
          'label' => 'Lastname'));?>
    </div>

    <div class="form-group">
      <?php echo $this->Form->input('qualification_title',
        array('class' => 'form-control', 'required' => 'required',
          'label' => 'Qualification Title'));?>
    </div>

    <div class="form-group">
      <?php echo $this->Form->input('assessment_date', 
        array('class' => 'form-control col-3 d-inline', 'required' => 'required',
        'label' => 'Date of Assessment&nbsp'));?>
    </div>

    <div class="form-group">
      <?php echo $this->Form->input('center',
        array('class' => 'form-control', 'required' => 'required',
          'label' => 'Name of Training Center/Company'));?>
    </div>

    <div class="form-group">
      <?php echo $this->Form->input('venue',
        array('class' => 'form-control', 'required' => 'required',
          'label' => 'Name of Assessment Center/Venue'));?>
    </div>       

    <div class="form-group">
      <?php echo $this->Form->input('email_address', 
        array('class' => 'form-control', 'required' => 'required'));?>
    </div>

    <div class="form-group">
      <?php echo $this->Form->input('contact_number', 
        array('class' => 'form-control', 'required' => 'required',
          'label' => 'Contact Number'));?>
    </div>

    <?php echo $this->Form->end($options); ?>
    </center>
  </div>
</div>