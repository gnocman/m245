<?php

namespace Magenest\DatabaseEAV\Block;

use Magenest\DatabaseEAV\Model\ResourceModel\Post\CollectionFactory;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\View\Element\Template;

/**
 *
 */
class Movie extends Template
{
    /**
     * @var CollectionFactory
     */
    public CollectionFactory $collection;

    /**
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(Context $context, CollectionFactory $collectionFactory, array $data = [])
    {
        $this->collection = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function getCollection(): array
    {
        return $this->collection->create()->getItems();
//        return $this->collection->create()->getData();
    }

    /**
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('frontend/page/save', ['_secure' => true]);
    }
}

