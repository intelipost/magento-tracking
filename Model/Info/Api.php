<?php

class Intelipost_Tracking_Model_Info_Api
{

public function addurl ($url)
{
    if (empty ($url)) return false;

    $config = Mage::getModel ('core/config');
    $config->saveConfig ('intelipost_tracking/info/url', $url, 'default', 0);

    return true;
}

public function addNumber ($order_increment_id, $number)
{
    $order = Mage::getModel ('sales/order')->loadByIncrementId ($order_increment_id);
    if (!$order || !$order->getId ()) return false;

    $result = false;

    foreach ($order->getShipmentsCollection () as $shipment)
    {
        $track = Mage::getModel('sales/order_shipment_track')
            ->setCarrierCode ('tracking')
            ->setTitle (Mage::helper ('tracking')->__('Intelipost Tracking'))
            ->setNumber ($number);

        $shipment->addTrack($track);
        $shipment->save ();

        $result = true;

        break;
    }

    return $result;
}

}

