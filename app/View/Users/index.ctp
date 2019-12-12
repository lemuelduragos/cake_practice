<div class="container col-md-6" ng-controller="userController">
  <div class="row">
    <div class="col-lg-12" >
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">User Profile</h3>
        </div>
        <div class="panel-body">
          <div class="row">
          <img ng-src="../{{user.0.User.photo}}" class="img-rounded" alt="Profile Picture" width="200px" height="200px" style="margin-top:20px" />
            <div class=" col-md-9 col-lg-9 "> 
              <table class="table table-user-information">
                <tbody>
                  <tr>
                    <td>First Name:</td>
                    <td>{{user.0.User.first_name}}</td>
                  </tr>
                  <tr>
                    <td>Middle Name:</td>
                    <td>{{user.0.User.middle_name}}</td>
                  </tr>
                  <tr>
                    <td>Last Name:</td>
                    <td>{{user.0.User.last_name}}</td>
                  </tr>
                  <tr>
                  <tr>
                    <td>Email Address:</td>
                    <td>{{user.0.User.email_address}}</td>
                  </tr>
                  <tr>
                    <td>Shipping address:</td>
                    <td>{{user.0.User.shipping_address}}</td>
                  </tr>
                  <tr>
                    <td>City:</td>
                    <td>{{user.0.User.city}}</td>
                  </tr>
                    <td>Zip Code:</td>
                    <td>{{user.0.User.zip_code}}</td>
                  </tr>
                </tbody>
              </table>
              <div class="float-right">
                <a href="http://localhost.com/cake_practice/users/edit" class="btn btn-info">Edit Profile</a>
                <a href="http://localhost.com/cake_practice/users/security" class="btn btn-warning">Change Username and Password</a>
              </div>
          </div>
        </div>  
      </div>
    </div>
  </div>
</div>