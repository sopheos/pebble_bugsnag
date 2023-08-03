<?php

namespace Pebble\Bugsnag;

/**
 * DefaultHandler
 *
 * @author mathieu
 */
class DefaultHandler implements HandlerInterface
{
    const NOTICE = 'PHP Notice';
    const WARNING = 'PHP Warning';
    const ERROR = 'PHP error';

    // -------------------------------------------------------------------------

    /**
     * @param \Throwable $exception
     * @param array $data
     * @return \static
     */
    public function notice(\Throwable $exception, array $data = [])
    {
        $this->notify(self::NOTICE, $exception, $data);
        return $this;
    }

    /**
     * @param \Throwable $exception
     * @param array $data
     * @return \static
     */
    public function warning(\Throwable $exception, array $data = [])
    {
        $this->notify(self::WARNING, $exception, $data);
        return $this;
    }

    /**
     * @param \Throwable $exception
     * @param array $data
     * @return \static
     */
    public function error(\Throwable $exception, array $data = [])
    {
        $this->notify(self::ERROR, $exception, $data);
        return $this;
    }

    // -------------------------------------------------------------------------

    /**
     * @param string $severity
     * @param \Throwable $ex
     * @param array $data
     * @return string
     */
    protected function notify(string $severity, \Throwable $ex, array $data = [])
    {
        $message = $severity . ': '
            . $ex->getMessage()
            . ' in ' . $ex->getFile()
            . ':' . $ex->getLine();

        if ($data) {
            $message .= "
" . 'Extra data:' . "
" . print_r($data, true);
        }
        $message .= "
" . 'Stack trace:' . "
" . $ex->getTraceAsString();

        error_log($message);
        return $message;
    }

    // -------------------------------------------------------------------------
}
