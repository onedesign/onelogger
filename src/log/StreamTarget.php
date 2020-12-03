<?php
namespace onedesign\onelogger\log;

use yii\log\Logger;
use yii\log\Target;
use yii\base\InvalidConfigException;

class StreamTarget extends Target
{
  /**
   * Writes a log message to stderr
   * @throws InvalidConfigException if unable to open the stream for writing
   */
  public function export()
  {
    $text = implode("\n", array_map([$this, 'formatMessage'], $this->messages)) . "\n";
    if(false == file_put_contents("php://stderr", $text)) {
      throw new InvalidConfigException("Unable to log to stderr!");
    }
  }

  /**
   * Processes the given log messages.
   * This method will filter the given messages with [[levels]] and [[categories]].
   * And if requested, it will also export the filtering result to specific medium (e.g. email).
   * @param array $messages log messages to be processed. See [[Logger::messages]] for the structure
   * of each message.
   * @param bool $final whether this method is called at the end of the current application
   */
  public function collect($messages, $final)
  {
    $this->messages = array_merge($this->messages, static::filterMessages($messages, $this->getLevels(), $this->categories, $this->except));
    $count = count($this->messages);
    if ($count > 0 && ($final || $this->exportInterval > 0 && $count >= $this->exportInterval)) {
      if (($context = $this->getContextMessage()) !== '') {
        $this->messages[] = [$context, Logger::LEVEL_INFO, 'application', YII_BEGIN_TIME];
      }
      // set exportInterval to 0 to avoid triggering export again while exporting
      $oldExportInterval = $this->exportInterval;
      $this->exportInterval = 0;
      $this->export();
      $this->exportInterval = $oldExportInterval;

      $this->messages = [];
    }
  }
}
