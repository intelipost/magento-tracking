<?php

class Intelipost_Tracking_WebhookController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
	{
		$start = microtime();

        if ($this->getRequest()->isPost() && $webhookActive)
		{
			if ($this->getRequest()->getHeader('api-key') == Mage::helper('basic')->getDecriptedKey('apikey'))
			{
				$pre_dispatch_events = array('NEW', 'READY_FOR_SHIPPING', 'SHIPPED');
				$post_dispatch_events = array('TO_BE_DELIVERED', 'IN_TRANSIT', 'DELIVERED', 'CLARIFY_DELIVERY_FAIL', 'DELIVERY_FAILED');

				$value = json_decode($this->getRequest()->getRawBody());								
				$order_id = $value->order_number;

				if (Mage::getStoreConfig('intelipost_tracking/webhook/format_order_prefix'))
				{
					if (strpos(Mage::getStoreConfig('intelipost_tracking/webhook/order_prefix'), ',') !== false)
					{
						$result = explode(',', Mage::getStoreConfig('intelipost_tracking/webhook/order_prefix'));

						foreach ($result as $r) 
						{
							$order_id = trim(str_replace($r, '', $order_id));
						}
					}
					else
					{
						$order_id = trim(str_replace(Mage::getStoreConfig('intelipost_tracking/webhook/order_prefix'), '', $order_id));
					}
				}

				if (Mage::getStoreConfig('intelipost_tracking/webhook/format_order_sufix'))
				{
					if (strpos(Mage::getStoreConfig('intelipost_tracking/webhook/order_sufix'), ',') !== false)
					{
						$result = explode(',', Mage::getStoreConfig('intelipost_tracking/webhook/order_sufix'));

						foreach ($result as $r) 
						{
							$order_id = trim(str_replace($r, '', $order_id));
						}
					}
					else
					{
						$order_id = trim(str_replace(Mage::getStoreConfig('intelipost_tracking/webhook/order_sufix'), '', $order_id));
					}
				}

				$order = Mage::getModel('sales/order')->load($order_id, 'increment_id');

				$state = $value->history->shipment_order_volume_state;

				if ((in_array($state, $pre_dispatch_events) && $tracking_pre_dispatch)
					|| in_array($state, $post_dispatch_events) && $tracking_post_dispatch)
				{								

					switch (strtoupper($state))
					{
						case 'NEW':
							$status = Mage::getStoreConfig ("intelipost_tracking/webhook/new");
							$order->setStatus ($status);
							break;					

						case 'READY_FOR_SHIPPING':
							$status = Mage::getStoreConfig ("intelipost_tracking/webhook/ready_for_shipping");
							$order->setStatus ($status);
							break;

						case 'SHIPPED':
							$status = Mage::getStoreConfig ("intelipost_tracking/webhook/shipped");
							$order->setStatus ($status);
							break;

						case 'TO_BE_DELIVERED':
							$status = Mage::getStoreConfig ("intelipost_tracking/webhook/to_be_delivered");
							$order->setStatus ($status);
							break;
						
						case 'IN_TRANSIT':
							$status = Mage::getStoreConfig ("intelipost_tracking/webhook/in_transit");
							$order->setStatus ($status);
							break;

						case 'DELIVERED':
							$status = Mage::getStoreConfig ("intelipost_tracking/webhook/delivered");
							$order->setStatus ($status);
							break;

						case 'CLARIFY_DELIVERY_FAIL':
							$status = Mage::getStoreConfig ("intelipost_tracking/webhook/delivery_late");
							$order->setStatus ($status);
							break;

						case 'DELIVERY_FAILED':
							$status = Mage::getStoreConfig ("intelipost_tracking/webhook/delivery_failed");
							$order->setStatus ($status);
							break;
					}

					if (Mage::getStoreConfig('intelipost_tracking/webhook/save_comments'))
					{
						$comments_options = '';
						$admin_ident_prefix = '[Intelipost Webhook] - ';
						$comment = $value->history->provider_message;
						$order->addStatusHistoryComment($admin_ident_prefix . $comment);

						if (Mage::getStoreConfig('intelipost_tracking/webhook/show_frontend_comments'))
						{
							$comments_options = Mage::getStoreConfig('intelipost_tracking/webhook/frontend_comment_options');
							if (strpos($comments_options, ',') !== false) {
								$comments_options = explode(',', $comments_options);
							}
						}

						if (is_array($comments_options))
						{						
							foreach($order->getShipmentsCollection() as $shipment)
        					{
        						$shipment->addComment($comment, false, true);
        						$shipment->save();
        					}

							$order->addStatusHistoryComment($comment)->setIsVisibleOnFront(1);
						}
						else
						{
							if ($comments_options == 'order')
							{
								$order->addStatusHistoryComment($comment)->setIsVisibleOnFront(1);
							}
							else
							{
								foreach($order->getShipmentsCollection() as $shipment)
	        					{
	        						$shipment->addComment($comment, false, true);
	        						$shipment->save();
	        					}
							}
						}
					}

					$order->save();			
				}		
			}
		}   

		$time_elapsed_secs = microtime() - $start;

		printf('Tempo Processamento: %.5f sec',  $time_elapsed_secs);   
	}
}
