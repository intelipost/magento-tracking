<?php

class Intelipost_Tracking_Model_Config_Comments_Options
{        

public function toOptionArray()
{
	return array(	array('label' => 'Pedido', 'value' => 'order'),
					array('label' => 'Entrega', 'value' => 'shipment')
				);
}

}

