<?php

class Bluecom_Addstep_Block_Onepage_Addstep extends Mage_Checkout_Block_Onepage_Abstract {

    protected function _construct() {
        $this->getCheckout()->setStepData('addstep', array(
            'label' => Mage::helper('checkout')->__('Addstep Review'),
            'is_show' => $this->isShow(),
        ));

        if($this->isCustomerLoggedIn()) {
            $this->getCheckout()->setStepData('addstep', 'allow', true);
            $this->getCheckout()->setStepData('billing', 'allow', false);
        }

        parent::_construct();
    }
}