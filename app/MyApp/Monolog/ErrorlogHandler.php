<?php

namespace MyApp\Monolog;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Formatter\LineFormatter;

/**
 * Writes to the standard PHP error log
 *
 * @author Mathew Attlee
 */
class ErrorlogHandler extends AbstractProcessingHandler
{


    /**
     * @param integer $level  The minimum logging level at which this handler will be triggered
     * @param Boolean $bubble Whether the messages that are handled can bubble up the stack or not
     */
    public function __construct($level = Logger::DEBUG, $bubble = true)
    {
        parent::__construct($level, $bubble);
    }

    /**
     * {@inheritdoc}
     */
    protected function write(array $record)
    {
        error_log((string) $record['formatted']);
    }
    
    /**
     * {@inheritdoc}
     */
    protected function getDefaultFormatter()
    {
        return new LineFormatter('%channel%.%level_name%: %message% %context% %extra%\n');
    }    
}
