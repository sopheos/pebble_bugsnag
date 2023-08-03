<?php

namespace Pebble\Bugsnag;

/**
 * Handler
 *
 * @author mathieu
 */
interface HandlerInterface
{
    /**
     * @param \Throwable $exception
     * @param array $data
     * @return \static
     */
    public function notice(\Throwable $exception, array $data = []);

    /**
     * @param \Throwable $exception
     * @param array $data
     * @return \static
     */
    public function warning(\Throwable $exception, array $data = []);

    /**
     * @param \Throwable $exception
     * @param array $data
     * @return \static
     */
    public function error(\Throwable $exception, array $data = []);
}
