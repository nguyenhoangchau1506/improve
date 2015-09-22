<?php
$installer = $this;
$installer->startSetup();
$status = $installer->getTable('sales/order_status');
$installer->getConnection()->insertArray(
    $status,
    array('status', 'label'),
    array(
        array(
            'status' => 'new_status',
            'label' => 'New Status'
        )
    )
);
$installer->getConnection()->insertArray(
    $status,
    array('status', 'label'),
    array(
        array(
            'status' => 'new_status_2',
            'label' => 'New Status 2'
        )
    )
);

$statusState = $installer->getTable('sales/order_status_state');
$installer->getConnection()->insertArray(
    $statusState,
    array('status', 'state', 'is_default'),
    array(
        array(
            'status' => 'new_status',
            'state' => 'new_state',
            'is_default' => 1
        )
    )
);

$installer->endSetup();
