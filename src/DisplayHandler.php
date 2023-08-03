<?php

namespace Pebble\Bugsnag;

/**
 * DevHandler
 *
 * @author mathieu
 */
class DisplayHandler extends DefaultHandler
{
    /**
     * @var boolean
     */
    private $is_cli = false;

    // -------------------------------------------------------------------------

    /**
     * @param boolean $is_cli
     */
    public function __construct()
    {
        $this->is_cli = (php_sapi_name() === 'cli' or defined('STDIN'));
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
        $message = parent::notify($severity, $ex, $data);

        if ($this->is_cli) {
            echo $message . "
";
            return $message;
        }

        $styles = [
            'margin: 5px 0',
            'padding: 10px',
            'color: #000',
            'background: #eee',
            'border: 1px solid #f00',
        ];

        echo '<pre style="' . join(';', $styles) . ';">';
        echo $message;
        echo '</pre>';

        return $message;
    }

    // -------------------------------------------------------------------------
}
