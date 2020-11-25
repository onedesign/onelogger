<?php
/**
 * onelogger plugin for Craft CMS 3.x
 *
 * Logging Alternative for Craft CMS 3.x using STDOUT and STDERR
 *
 * @link      https://onedesigncompany.com
 * @copyright Copyright (c) 2018 One Design Company
 */

namespace onedesign\onelogger;


use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;

use yii\base\Event;

/**
 * Class OneLogger
 *
 * @author    One Design Company
 * @package   Onelogger
 * @since     2.0.0
 *
 */
class OneLogger extends Plugin
{
  // Static Properties
  // =========================================================================

  /**
   * @var Onelogger
   */
  public static $plugin;

  // Public Properties
  // =========================================================================

  /**
   * @var string
   */
  public $schemaVersion = '2.0.1';

  // Public Methods
  // =========================================================================

  /**
   * @inheritdoc
   */
  public function init()
  {
    parent::init();
    self::$plugin = $this;

    // Creates a stream target that writes to php://stderr
    $streamTarget = new \onedesign\onelogger\StreamTarget();
    $streamTarget->setLevels($this->settings->logLevels);
    Craft::getLogger()->dispatcher->targets[] = $streamTarget;

    Craft::info(
      Craft::t(
        'onelogger',
        '{name} plugin loaded',
        ['name' => $this->name]
      ),
      __METHOD__
    );
  }

  // Protected Methods
  // =========================================================================

  protected function createSettingsModel()
  {
    return new \onedesign\onelogger\models\Settings();
  }
}
