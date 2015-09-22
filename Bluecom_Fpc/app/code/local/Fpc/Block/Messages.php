<?php

class Bluecom_Fpc_Block_Messages extends Mage_Core_Block_Template
{
    protected $messages;

    protected function _construct()
    {
        $this->setTemplate('bluecom/fpc/messages.phtml');
        $_luckyNumbers = array(rand(0,99),rand(0,99),rand(0,99),rand(0,99));
        $_time = Mage::getSingleton('core/date')->timestamp(time());
        $this->messages = "<div>Hi! Your lucky numbers are ".implode(', ',$_luckyNumbers).". <small>Last updated: ".date('F d Y, h:i:s a', $_time)."</small></div>";
    }

    protected function _toHtml()
    {
        return $this->messages;
    }
}