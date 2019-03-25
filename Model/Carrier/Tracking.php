<?php

class Intelipost_Tracking_Model_Carrier_Tracking
extends Mage_Shipping_Model_Carrier_Abstract
implements Mage_Shipping_Model_Carrier_Interface
{

protected $_code = 'tracking';

public function collectRates (Mage_Shipping_Model_Rate_Request $request)
{
    return false;
}

public function getAllowedMethods ()
{
    return array ($this->_code => $this->getConfigData ('name'));
}

public function isTrackingAvailable ()
{
    return Mage::getStoreConfig ('intelipost_tracking/settings/active');
}

public function getTrackingInfo ($number)
{
    $result = $this->_getTrackingInfo ($number);

    if ($result instanceof Mage_Shipping_Model_Tracking_Result)
	{
        $trackings = $result->getAllTrackings ();

        return $trackings [0];
    }

    return false;
}

public function _getTrackingInfo ($number)
{
    $client_id = Mage::getStoreConfig ('intelipost_basic/settings/client_id');
    $shipment_track = Mage::getModel ('sales/order_shipment_track')->load ($number, 'track_number');
    $order_id = $shipment_track->getOrderId ();
    $order = Mage::getModel ('sales/order')->load ($order_id);
    $order_increment_id = $order->getIncrementId ();

	$status = Mage::getModel('shipping/tracking_result_status');
	$status->setTracking ($number);
	////$status->setCarrier ($this->getConfigData('name'));
	////$status->setCarrierTitle ($this->getConfigData('title'));

    $prefix = Mage::getStoreConfig('intelipost_tracking/webhook/order_prefix');
	$url = Mage::getStoreConfig ('intelipost_tracking/info/url') . DS . $client_id . DS . $prefix . $order_increment_id;
	try
	{
	    $client = new Zend_Http_Client();
	    $client->setUri($url);
	    $response = $client->request('GET');
	    $content = $response->getBody ();
	    $html = "<iframe width=\"100%\" height=\"700px\" src=$url></iframe>";
	}
	catch (Exception $e)
	{
	    $content = Mage::helper ('quote')->__('No tracking information available.');
	}
	$status->addData (array ('status' => $html));

    $result = Mage::getModel('shipping/tracking_result');
    $result->append ($status);

	return $result;
}

}

