<h1>Certification Requests</h1>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h4>Search Certificate Requests</h4>

    <?php 
    if(isset($_SESSION['Message']['success'])){
        echo "<div class='alert alert-success'>". $this->Flash->render('success')."</div>";
    } else if(isset($_SESSION['Message']['error'])) {
        echo "<div class='alert alert-danger'>". $this->Flash->render('error')."</div>";
    }

    echo "<center>";

    echo $this->Form->create('Certificate', array('class' => 'user form-inline col-md-6 text-center', 'type' => 'get')); 
      $options = array('label' => 'Search', 'class' => 'btn btn-success btn-md form-control', 'style' => 'margin-top:22px; margin-left:10px'); ?>
  	
  	<div class="form-group">
      <?php echo $this->Form->input('first_name',
        array('class' => 'form-control',
        	'style' => 'margin-left:10px',
        	'value' => isset($form_data['first_name']) ? $form_data['first_name'] : "",
          	'label' => 'Firstname'));?>
  	</div>

    <div class="form-group">
      <?php echo $this->Form->input('middle_name',
       array('class' => 'form-control control-group',
       		'style' => 'margin-left:10px',
       		'value' => isset($form_data['middle_name']) ? $form_data['middle_name'] : "",
          	'label' => 'Middlename'));?>
  	</div>		

   <div class="form-group">
      <?php echo $this->Form->input('last_name',
        array('class' => 'form-control', 
        	'style' => 'margin-left:10px',
        	'value' => isset($form_data['last_name']) ? $form_data['last_name'] : "",
          	'label' => 'Lastname'));?>
    </div>

     <div class="form-group">
      <?php echo $this->Form->input('status', 
        array('class' => 'form-control', 
        	'value' => isset($form_data['status']) ? $form_data['status'] : "",
        	'type' => 'select',
        	'options' => $status_options,
        	'style' => 'margin-left:10px'));?>
    </div>

    <div class="form-group">
      <?php echo $this->Form->input('qualification_title',
        array('class' => 'form-control', 
        	'style' => 'margin-left:10px',
        	'value' => isset($form_data['qualification_title']) ? $form_data['qualification_title'] : "",
          	'label' => 'Qualification Title'));?>
    </div>

    <div class="form-group">
      <?php echo $this->Form->input('center',
        array('class' => 'form-control', 
        	'style' => 'margin-left:10px',
        	'value' => isset($form_data['center']) ? $form_data['center'] : "",
          	'label' => 'Training Center/Company'));?>
    </div>

    <div class="form-group">
      <?php echo $this->Form->input('venue',
        array('class' => 'form-control', 
        	'style' => 'margin-left:10px',
        	'value' => isset($form_data['venue']) ? $form_data['venue'] : "",
          	'label' => 'Center/Venue'));?>
    </div>       

    <div class="form-group">
      <?php echo $this->Form->input('email_address', 
        array('class' => 'form-control', 
        	'value' => isset($form_data['email_address']) ? $form_data['email_address'] : "",
        	'style' => 'margin-left:10px'));?>
    </div>

    <div class="form-group">
      <?php echo $this->Form->input('contact_number', 
        array('class' => 'form-control', 
        	'style' => 'margin-left:10px',
        	'value' => isset($form_data['contact_number']) ? $form_data['contact_number'] : "",
          	'label' => 'Contact Number'));?>
    </div>

 	<div class="form-group">
    	<?php echo $this->Form->end($options); ?>
	</div>

	</center>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Qualification Title</th>
            <th>Assessment Date</th>
            <th>Center</th>
            <th>Venue</th>
            <th>Email Address</th>
            <th>Conact Number</th>
            <th>Status</th>
            <th>Request Date</th>
          </tr>
        </thead>
        <tbody>
        	<?php
        	$options = array('label' => 'Update', 'class' => 'btn btn-primary btn-sm');

    		foreach ($requests as $value) {
    			$log = $value["Certificate"];

    			echo "<tr>";

    			echo "<td>" .$log['first_name']. "</td>";
    			echo "<td>" .$log['middle_name']. "</td>";
    			echo "<td>" .$log['last_name']. "</td>";
    			echo "<td>" .$log['qualification_title']. "</td>";
    			echo "<td>" .$log['assessment_date']. "</td>";
    			echo "<td>" .$log['center']. "</td>";
    			echo "<td>" .$log['venue']. "</td>";
    			echo "<td>" .$log['email_address']. "</td>";
    			echo "<td>" .$log['contact_number']. "</td>";
    			echo "<td>";
    			echo $this->Form->create('Certificate', array('url'   => array('controller' => 'certificates','action' => 'update_status'), 
    				'class' => 'user form-inline float-right', 'style'=> 'margin-top:5px')); 
    			echo $this->Form->input('id', 
			      	array('class' => 'form-control', 
			        	'type' => 'hidden',
			        	'value' => $log['id'],
			        	'label' => false,)
			      );
    			echo $this->Form->input('first_name', 
			      	array('class' => 'form-control', 
			        	'type' => 'hidden',
			        	'value' => $log['first_name'],
			        	'label' => false,)
			      );
    			echo $this->Form->input('middle_name', 
			      	array('class' => 'form-control', 
			        	'type' => 'hidden',
			        	'value' => $log['middle_name'],
			        	'label' => false,)
			      );
    			echo $this->Form->input('last_name', 
			      	array('class' => 'form-control', 
			        	'type' => 'hidden',
			        	'value' => $log['last_name'],
			        	'label' => false,)
			      );
    			echo $this->Form->input('email_address', 
			      	array('class' => 'form-control', 
			        	'type' => 'hidden',
			        	'value' => $log['email_address'],
			        	'label' => false,)
			      );
				echo $this->Form->input('last_status', 
			      	array('class' => 'form-control', 
			        	'type' => 'hidden',
			        	'value' => $log['status'],
			        	'label' => false,)
			      );
    			echo $this->Form->input('status', 
			      	array('class' => 'form-control', 
			        	'type' => 'select',
			        	'options' => $status_options,
			        	'value' => $log['status'],
			        	'label' => false,)
			      );
    			echo $this->Form->end($options);
    			echo "</td>";
    			echo "<td>" .$log['created']. "</td>";


    			echo "</tr>";
    		}
        	?>
        </tbody>
      </table>
    </div>
    	<div style="float:right">
		    <?php 
	      		echo $this->Paginator->prev('« Previous  ', null, null, array('class' => 'disabled'));
	      		echo $this->Paginator->numbers();
				echo $this->Paginator->next('  Next »', null, null, array('class' => 'disabled'));
		    ?>
  		</div>
  </div>
</div>