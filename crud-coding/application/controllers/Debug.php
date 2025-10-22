<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Debug extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    // Show last 200 lines of the latest log file (development use only)
    public function log()
    {
        $logs = glob(APPPATH.'logs/log-*.php');
        if (empty($logs))
        {
            echo "No log files found in application/logs/. Make the error happen and retry.";
            return;
        }

        usort($logs, function($a, $b){ return filemtime($b) - filemtime($a); });
        $file = $logs[0];
        $lines = @file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === FALSE) {
            echo "Unable to read log file: $file";
            return;
        }

        $tail = array_slice($lines, -200);
        echo "<pre>".htmlspecialchars(implode("\n", $tail))."</pre>";
    }

    // Simple method to force an exception (development only)
    public function crash()
    {
        throw new Exception('Debug crash triggered');
    }
}
