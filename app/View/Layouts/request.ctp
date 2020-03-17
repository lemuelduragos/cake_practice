<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Queue System');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html ng-app="eTesda">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->script('jquery.min');
		// echo $this->Html->css('sb-admin-2.min');
		echo $this->Html->css('sb-admin-2');
		echo $this->Html->css('all.min');
		echo $this->Html->css('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i');
		echo $this->Html->script('angular.min');
		echo $this->Html->script('angularscript');
		echo $this->Html->script('sb-admin-2.min');
		echo $this->Html->script('fontawesome.min');
		echo $this->Html->script('jquery.easing.min');
		echo $this->Html->script('bootstrap.bundle.min');
		echo $this->Html->script('bootstrap.min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

	 	if(isset($_SESSION['Auth']['User'])){
		   	$role = $_SESSION['Auth']['User']['role'];
		   	$stringRole = "";
		   	switch($role) {
		   		case 1: 
		   			$stringRole = " [Admin]";
		   			break;
		   		default: 
		   			$stringRole = " [Staff]";
		   			break;
	   		}
	   		$fullname = $stringRole." ".$_SESSION['Auth']['User']['first_name']." ".$_SESSION['Auth']['User']['last_name'];
			$status = 'Login';
		} else {
			$status = 'Logout';
			$fullname='Hello, Guest';
		}
	?>
</head>
  <body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"/>

          <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
              <i class="fas fa-cog"></i>
            </div>
            <div class="sidebar-brand-text mx-3">E-TESDA Information System</div>
          </a>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          	<!-- Page Heading -->
        	<?php echo $this->Session->flash(); ?>

			     <?php echo $this->fetch('content'); ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login">Logout</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<!-- <?php echo $this->element('sql_dump'); ?> -->