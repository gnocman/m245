<?php

namespace Magenest\DatabaseEAV\Cron;

use Zend\Log\Logger;
use Zend\Log\Writer\Stream;

/**
 *
 */
class Test
{

    /**
     * @return $this
     */
    public function execute()
    {

        $writer = new Stream(BP . '/var/log/cron.log');
        $logger = new Logger();
        $logger->addWriter($writer);
        $logger->info(__METHOD__);

        return $this;

    }
}
