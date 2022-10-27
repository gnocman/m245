<?php

namespace Magenest\DatabaseEAV\Controller\Page;

use Magenest\DatabaseEAV\Model\PostFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;

/**
 *
 */
class Save extends Action
{
    /**
     * @var PageFactory
     */
    protected PageFactory $resultPageFactory;
    /**
     * @var PostFactory
     */
    private PostFactory $postFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param PostFactory $postFactory
     */
    public function __construct(
        Context     $context,
        PageFactory $resultPageFactory,
        PostFactory $postFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
        $this->postFactory = $postFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\Result\Redirect&\Magento\Framework\Controller\ResultInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {
            $data = $this->getRequest()->getParams();
            $check = $data['rating'];
            if (0 < $check && $check < 6) {
                $model = $this->postFactory->create();
                $model->addData([
                    "name" => $data['name'],
                    "description" => $data['description'],
                    "rating" => $data['rating'],
                ]);
                $model->save();
                $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
            } else {
                $this->messageManager->addErrorMessage(__('Insert data Error,Please Checking Entering ... !'));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t submit your request, Please try again."));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
