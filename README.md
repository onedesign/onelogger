# onelogger plugin for Craft CMS 3.x

An alternative logger for Craft CMS, including STDOUT.

Looking for Craft 2 Support? [OneLogger for Craft 2](https://github.com/onedesign/onelogger/tree/v1)

## Why?

This is primarily useful Craft sites hosted on Heroku, which uses STDOUT/STDERR for logging.

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

# onelogger plugin for Craft CMS 3.x

Logging Alternative for Craft CMS 3.x using STDOUT and STDERR

![Screenshot](resources/img/plugin-logo.png)

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

```
{
    "repositories": [
      {
        "type": "vcs",
        "url": "https://github.com/onedesign/onelogger"
      }
    ],

    "require": {
        "onedesign/onelogger": "^2.0",
    }
}
```
        composer update onedesign/onelogger

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for onelogger.


## Configuration

You can configure the log levels that show up in the stderr logs by adding a `onelogger.php` config file (and an ENV var).

`config/onelogger.php`
```
<?php

return [
  'logLevels' => getenv('ONELOGGER_LOG_LEVELS') ? explode(',', getenv('ONELOGGER_LOG_LEVELS')) : ['warning', 'error']
];

```

`.env`
```
# Set which Craft log levels you want to see in stderr
ONELOGGER_LOG_LEVELS="warning,error,info,trace,profile"
```


## Usage

Log events in Craft as you normally would (eg `Craft::log('Uh oh! Error!', LogLevel::Error)` or `MyPlugin::log(...)`), and you'll see the logs in STDOUT.

For example, if you are using Heroku, you can see logs from the command line using:

```
heroku logs --tail -a app-name
```

You'll continue seeing logs using Craft's normal filesystem logs. If you're hosting on Heroku, this are ephemeral and will disappear.

