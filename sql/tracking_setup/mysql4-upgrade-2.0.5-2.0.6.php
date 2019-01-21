<?php
$installer = $this;
 
// Required tables
$statusTable = $installer->getTable('sales/order_status');
 
// Insert statuses
$installer->getConnection()->insertArray(
    $statusTable,
    array(
        'status',
        'label'
    ),
    array(
        array('status' => 'ip_to_be_delivered', 'label' => 'Saiu para Entrega'),
        array('status' => 'ip_in_transit', 'label' => 'Em trânsito'),
        array('status' => 'ip_shipped', 'label' => 'Despachado'),
        array('status' => 'ip_delivered', 'label' => 'Entregue'),
        array('status' => 'ip_delivery_late', 'label' => 'Atraso na entrega'),
        array('status' => 'ip_delivery_failed', 'label' => 'Entrega Falhou')
    )
);