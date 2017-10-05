<?php

class Cart extends AppModel
{
	public $virtualFields = array(
    'name' => 'product.name',
    'total' => 'Cart.quantity * product.price'
	);
}


?>