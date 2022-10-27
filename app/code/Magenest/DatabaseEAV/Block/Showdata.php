<?php

namespace Magenest\DatabaseEAV\Block;

use Magento\Backend\Block\Template\Context;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;

/**
 *
 */
class Showdata extends Template
{
    /**
     * @var Session
     */
    private Session $customerSession;

    /**
     * @param Context $context
     * @param Session $customerSession
     * @param array $data
     */
    public function __construct(
        Context $context,
        Session $customerSession,
        array   $data = []
    ) {
        parent::__construct($context, $data);
        $this->customerSession = $customerSession;
    }

    /**
     * @return bool
     */
    public function isCustomerLoggedIn(): bool
    {
        return $this->customerSession->isLoggedIn();
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getCustomerName(): string
    {
        return $this->customerSession->getCustomer()->getName();
    }

    /**
     * @return string
     */
    public function getCustomerEmail()
    {
        return $this->customerSession->getCustomer()->getEmail();
    }
}
