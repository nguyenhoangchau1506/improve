<?php

class Bluecom_CustomAttribute_Model_Observer {

    public function salesQuoteItemSetCustomAttribute($observer) {
        $quoteItem = $observer->getQuoteItem();
        $product = $observer->getProduct();
        $quoteItem->setCustomAttribute($product->getCustomAttribute());
    }
}