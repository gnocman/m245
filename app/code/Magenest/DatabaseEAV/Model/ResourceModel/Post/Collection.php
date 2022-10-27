<?php

namespace Magenest\DatabaseEAV\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 *
 */
class Collection extends AbstractCollection
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magenest\DatabaseEAV\Model\Post', 'Magenest\DatabaseEAV\Model\ResourceModel\Post');
    }

}
