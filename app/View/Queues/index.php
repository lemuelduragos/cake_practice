<div class="container col-md-6" ng-controller="registrarQueueController" style="margin-bottom: 100px">
  <div class="row">
    <div class="col-12">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Now Serving</h3>
        </div>
        <div class="panel-body" src>

          <!-- Now Serving client numbers -->
          <div class="row">

              <div class="col-lg-3 alert" ng-class="{'alert-warning' : role == 1, 'alert-default' : role != 1}"> 
                <h5 class="panel-title">Registrar(You)</h5>
                <h1 class="panel-title">{{serving_registrar}}</h1>
              </div>

              <div class="col-lg-3 alert" ng-class="{'alert-warning' : role == 2, 'alert-default' : role != 2}" style="margin-right: 5px; margin-left: 5px"> 
                <h5 class="panel-title">Cashier</h5>
                <h1 class="panel-title">{{serving_cashier}}</h1>
              </div>

             <div class="col-lg-3 alert" ng-class="{'alert-warning' : role == 3, 'alert-default' : role != 3}"> 
                <h5 class="panel-title">Bookkeeper</h5>
                <h1 class="panel-title">{{serving_bookkeeper}}</h1>
              </div>
                 
              </div>

          </div>
          <!-- Now Serving client numbers end-->
          <br/><br/>
          <div class="row">
              <div class="col-lg-6"> 
                <h3 class="panel-title">Bookkeeper Clients On Queue</h3>
                <h5 class="panel-title">Total on queue : {{queue.length}}</h5>
              </div>

              <div class="col-lg-6"> 
                <button ng-click="nextRegistrar(queue)" class="btn-success btn btn-md float-right">Next Client</button>
              </div>
          </div>
          <br/>
            
            <!-- QUEUE LIST -->
          <div class="row">
            <table class="table" >
              <thead>
                <tr >
                  <th>Priority #</th>
                  <th>Name</th>
                  <th>ID Number</th>
                  <th>Contact #</th>
                  <th>Client Type</th>
                  <th>Office</th>
                </tr>
              </thead>
              <tbody>
                 <tr ng-repeat="client in queue">
                    <td>{{client.Queue.priority}}</td>
                    <td>{{client.Queue.name}}</td>
                    <td>{{client.Queue.id_number}}</td>
                    <td>{{client.Queue.contact_number}}</td>
                    <td>{{getClientType(client.Queue.type)}}</td>
                    <td>{{getOfficeIntended(client.Queue.office)}}</td>
                </tr>
              </tbody> 
            </table>
          </div>
          <!-- QUEUE LIST END-->

          </div>
        </div>  
      </div>
    </div>
  </div>
</div>
