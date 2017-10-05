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

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html ng-app="orderingSystem">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min');
		echo $this->Html->script('angular.min');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('jquery.min');
		echo $this->Html->script('angularscript');



		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

		   if(isset($_SESSION['Auth']['User'])){
		   		$fullname = $_SESSION['Auth']['User']['first_name']." ".$_SESSION['Auth']['User']['last_name'];
				$status = 'Logout';
			} else {
				$status = 'Login';
				$fullname='Guest';
			}
	?>
</head>
<body>
	<div id="container" ng-controller="globalController">
		<div id="header" style="background-color: #DDB54C">
			<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
			  <div class="container">
			    <a href="http://localhost.com/cakeangular/products/index"><h1 class="navbar-brand">Ordering System</h1></a>
			    </button>
			    <div class="" id="">
			      <ul class="navbar-nav ml-auto">
			      	<li class="nav-item">
			      		<b><a class ="nav-link" href="http://localhost.com/cakeangular/users/index"><?php echo "Hello, ".$fullname; ?></a></b>
			      	</li> <span class ="nav-link">⋮</span>
			        <li class="nav-item">
			          <?php echo $this->HTML->link('Shop', array('action' => '../products/index'), array('class' => 'nav-link'))?>
			        </li> <span class ="nav-link">⋮</span>
			         <li class="nav-item">
			          <?php echo $this->HTML->link('Orders', array('action' => '../users/index'), array('class' => 'nav-link'))?>
			        </li> <span class ="nav-link">⋮</span>
			        <li class="nav-item">
			         	 <?php echo $this->HTML->link('Cart-{{count}}', array('action' => '../carts/index'), array('class' => 'nav-link', 'ng-click' => 'loadCart()'))?>
			        </li> <span class ="nav-link">⋮</span>
			        <li class="nav-item">
			          <?php echo $this->HTML->link('Profile', array('action' => '../users/index'), array('class' => 'nav-link'))?>
			        </li> <span class ="nav-link">⋮</span>
			        <li class="nav-item">
			          <?php 
			          echo $this->HTML->link($status, array('action' => '../users/'.$status), array('class' => 'nav-link'))
			          ?>
			        </li>
			      </ul>
			    </div>
			  </div>
			</nav>
		</div>
		<br><br><br>
		<div id="content">

			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
		</div>
	</div>
</body>

</html>
<!-- <?php echo $this->element('sql_dump'); ?> -->