<?php

class Intelipost_Tracking_Model_Order_Api
extends Mage_Sales_Model_Order_Api
{

public function addstatus ($order_increment_id, $status)
{
    $order_status = Mage::getStoreConfig ("intelipost_tracking/order_statuses/{$status}");
    if (empty ($order_status)) return false;

    $order = Mage::getModel ('sales/order')->loadByIncrementId ($order_increment_id);
    $order->setStatus ($order_status);
    $order->save ();

    return true;
}

}

