<?php

class Bluecom_Addstep_Block_Onepage extends Mage_Checkout_Block_Onepage {

    public function getSteps() {
        $steps = array();

        if(!$this->isCustomerLoggedIn()) {
            $steps['login'] = $this->getCheckout()->getStepData('login');
        }
        $stepsCodes = array('addstep','billing','shipping','shipping_method','payment','review');

        foreach($stepsCodes as $step) {
            $steps[$step] = $this->getCheckout()->getStepData($step);
        }
        return $steps;
    }

    public function getActiveStep() {
        return $this->isCustomerLoggedIn() ? 'addstep' : 'login';
    }
}