<?php

namespace Pebble\Bugsnag;

/**
 * ProdHandler
 *
 * @author mathieu
 */
class BugsnagHandler implements HandlerInterface
{
    const NOTICE = 'info';
    const WARNING = 'warning';
    const ERROR = 'error';

    /**
     * @var \Bugsnag\Client
     */
    private $bugsnag;

    // -------------------------------------------------------------------------

    public function __construct(\Bugsnag\Client $bugsnag)
    {
        $this->bugsnag = $bugsnag;
    }

    // -------------------------------------------------------------------------

    /**
     * @param \Throwable $exception
     * @param array $data
     * @return \static
     */
    public function notice(\Throwable $exception, array $data = [])
    {
        return $this->notify(self::NOTICE, $exception, $data);
    }

    /**
     * @param \Throwable $exception
     * @param array $data
     * @return \static
     */
    public function warning(\Throwable $exception, array $data = [])
    {
        return $this->notify(self::WARNING, $exception, $data);
    }

    /**
     * @param \Throwable $exception
     * @param array $data
     * @return \static
     */
    public function error(\Throwable $exception, array $data = [])
    {
        return $this->notify(self::ERROR, $exception, $data);
    }

    // -------------------------------------------------------------------------

    /**
     * @param string $severity
     * @param \Throwable $exception
     * @param array $data
     * @return \static
     */
    private function notify(string $severity, \Throwable $exception, array $data = [])
    {
        $this->bugsnag->notifyException($exception, function ($report) use ($severity, $data) {
            $report->setSeverity($severity);
            if ($data) {
                $report->setMetaData($data);
            }
        });

        return $this;
    }

    // -------------------------------------------------------------------------
}
