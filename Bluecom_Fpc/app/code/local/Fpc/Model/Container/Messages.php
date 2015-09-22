<?php
class Bluecom_Fpc_Model_Container_Messages extends Enterprise_PageCache_Model_Container_Abstract
{
    protected function _getCacheId()
    {
        return 'BLUECOM_FPC_MESSAGES_CACHE'.md5($this->_placeholder->getAttribute('cache_id')).'_'.$this->_getIdentifier();
    }

    protected function _renderBlock()
    {
        $blockClass = $this->_placeholder->getAttribute('block');
        $template = $this->_placeholder->getAttribute('template');
        $block = new $blockClass;
        $block->setTemplate($template);
        return $block->toHtml();
    }

    protected function _getIdentifier()
    {
        return $this->_getCookieValue(Enterprise_PageCache_Model_Cookie::COOKIE_MESSAGE, '');
    }

    protected function _saveCache($data, $id, $tags = array(), $lifetime = 5)
    {
        parent::_saveCache($data, $id, $tags, $lifetime);
    }
}