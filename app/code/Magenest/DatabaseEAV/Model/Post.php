<?php

namespace Magenest\DatabaseEAV\Model;

use Magento\Framework\Model\AbstractModel;

/**
 *
 */
class Post extends AbstractModel
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magenest\DatabaseEAV\Model\ResourceModel\Post');
    }

}
