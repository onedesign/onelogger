<?php

namespace Craft;

class OneLogger_StdOut extends \CFileLogRoute {
    public function init() {
        $this->levels = craft()->config->get('devMode') ? '' : 'error,warning';
        $this->filter = craft()->config->get('devMode') ? 'Craft\\LogFilter' : null;

        parent::init();
    }

    protected function processLogs($logs) {
        $types = array();

        foreach ($logs as $log) {
            list($message, $level, $category, $time) = $log;
            $message = LoggingHelper::redact($message);
            $force = isset($log[4]) && $log[4];
            $plugin = isset($log[5]) ? StringHelper::toLowerCase($log[5]) : 'craft';

            $message = $this->formatLogMessageWithForce($message, $level, $category, $time, $force, $plugin);
            $types[$plugin] = (isset($types[$plugin]) ? $types[$plugin] : '') . $message;
        }

        foreach ($types as $plugin => $text) {
            file_put_contents("php://stderr", $text);
        }
    }

    protected function formatLogMessageWithForce($message, $level, $category, $time, $force, $plugin) {
        $level = "[{$level}] ";
        $category = "[{$category}] ";
        $plugin = $plugin ? "[{$plugin}] " : '';
        $forced = $force ? "[Forced] " : '';
        return $level . $category . $plugin . $forced . $message . "\n";
    }
}
