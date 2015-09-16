<?php

class Bluecom_Addstep_Model_Type_Onepage extends Mage_Checkout_Model_Type_Onepage {

    public function saveAddstep($data) {
        if(empty($data)) {
            return array('error' => -1, 'message' => $this->_helper->__('Invalid data.'));
        }
        $this->getQuote()->setAddstepLike($data['like']);
        $this->getQuote()->collectTotals();
        $this->getQuote()->save();

        $this->getCheckout()
            ->setStepData('addstep', 'allow', true)
            ->setStepData('addstep', 'complete', true)
            ->setStepData('billing', 'allow', true);

        return array();
    }
}