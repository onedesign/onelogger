<?php
namespace onedesign\onelogger;

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
}
