
<h1>Admin Dashboad</h1>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Staffs' Activity Logs</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Id</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Date Added</th>
            <th>Controls</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($staffs as $value) {
              $user = $value["User"];
              $id = $user['id'];
              $name = $user['last_name'].", ".$user['first_name']." ".$user['middle_name'];
              echo "<tr>";

              echo "<td>" .$user['id']. "</td>";
              echo "<td>" .$user['first_name']. "</td>";
              echo "<td>" .$user['middle_name']. "</td>";
              echo "<td>" .$user['last_name']. "</td>";
              echo "<td>" .$user['created']. "</td>";

              echo "<td>"; 
                $route = '/logs/staff_logs?id='.$id.'&name='.$name;
                echo $this->Html->link('View Action Logs', $route,array('class' => 'btn-sm btn-success'));
              echo "</td>";

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