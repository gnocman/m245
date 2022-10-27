<?php

namespace Magenest\DatabaseEAV\Plugin;

use Magenest\DatabaseEAV\Controller\Page\Save;

/**
 *
 */
class AddName
{
    /**
     * @param Save $subject
     * @return void
     */
    public function beforeExecute(Save $subject): void
    {
        $name = $subject->getRequest()->getParam('name');
        $subject->getRequest()->setParam('name', $name . " Magenest");
    }
}
