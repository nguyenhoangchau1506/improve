<?php
class Bluecom_Codemodel_Model_Observer {

    public function addCodemodelAttribute($observer) {
        $quoteItem = $observer->getQuoteItem();
        $product = $observer->getProduct();
        $quoteItem->setCodeModel($product->getCodeModel());
    }
}