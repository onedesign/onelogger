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
  public $schemaVersion = '2.0.0';

  // Public Methods
  // =========================================================================

  /**
   * @inheritdoc
   */
  public function init()
  {
    parent::init();
    self::$plugin = $this;

    /*
    Event::on(
      Plugins::class,
      Plugins::EVENT_AFTER_INSTALL_PLUGIN,
      function (PluginEvent $event) {
        if ($event->plugin === $this) {
        }
      }
    );
    */

    $streamTarget = new \onedesign\onelogger\StreamTarget();
    $streamTarget->setLevels(['warning','error']); // All logs

    // include the new target to the dispatcher
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

}
