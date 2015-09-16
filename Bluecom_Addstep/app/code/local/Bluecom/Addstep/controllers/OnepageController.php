<?php
require_once 'Mage/Checkout/controllers/OnepageController.php';
class Bluecom_Addstep_OnepageController extends Mage_Core_Controller_Front_Action {

    public function saveAddstepAction() {

        if($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost('addstep', array());

            if(!isset($result['error'])) {
                $result['goto_section'] = 'billing';
            }
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }
}