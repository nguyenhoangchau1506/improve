<?php

$installer = $this;
$installer->startSetup();

$statusState = $installer->getTable('sales/order_status_state');
$installer->getConnection()->insertArray(
    $statusState,
    array('status', 'state', 'is_default'),
    array(
        array(
            'status' => 'new_status_2',
            'state' => 'new_state',
            'is_default' => 0
        )
    )
);

$installer->endSetup();