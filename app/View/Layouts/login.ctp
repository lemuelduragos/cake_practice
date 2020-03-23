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

?>
<!DOCTYPE html>
<html ng-app="eTesda">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Admin E-TESDA IS
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->script('jquery.min');
		echo $this->Html->css('sb-admin-2.min');
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
	?>
</head>
<body>
	<?php echo $this->Session->flash(); ?>

	<?php echo $this->fetch('content'); ?>
</body>
</html>
