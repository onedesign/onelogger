# One Logger

An alternative logger for Craft CMS, including STDOUT.

## Why?

This is primarily useful Craft sites hosted on Heroku, which uses STDOUT for logging.

## Installation

You can install One Logger via Composer or Manually.

### Via Composer (requires access to repo)

Add One Logger to your `composer.json` file:

```
{
    "repositories": [
        {
            "type": "git",
            "url": "git@github.com:onedesign/craft-onelogger.git"
        }
    ],

    "require": {
        "onedesign/craft-onelogger": "1.0",
    }
}
```

Then run `composer install`. Go to the Craft Control Panel to install and configure.

You'll probably also want to add the resuling directory, `craft/plugins/onelogger`, to your .gitignore:

### Manually

Alternatively, drop the contents of the plugin into a new `onelogger` directory in `craft/plugins`.

The resulting structure would look like this:

```
│craft
|...
├── plugins
|   |...
│   ├── onelogger
│   │   ├── LICENSE
│   │   ├── OneLoggerPlugin.php
│   │   ├── README.md
│   │   ├── composer.json
│   │   ├── composer.lock
│   │   ├── loggers
│   │   │   └── OneLogger_StdOut.php
```

## Usage

Log events in Craft as you normally would (eg `Craft::log('Uh oh! Error!', LogLevel::Error)` or `MyPlugin::log(...)`), and you'll see the logs in STDOUT.

For example, if you are using Heroku, you can see logs from the command line using:

```
heroku logs --tail -a app-name
```

You'll continue seeing logs using Craft's normal filesystem logs. (If you're hosting on Heroku, this are ephemeral and will disappear shortly.)
