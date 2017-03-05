# Published Event plugin for Craft CMS

Triggers a event for elements that was enabled at a given time.

![Icon](resources/icon.png)

## Installation

To install Published Event, follow these steps:

1. Download & unzip the file and place the `publishedevent` directory into your `craft/plugins` directory
2.  -OR- do a `git clone https://github.com/sjelfull/Craft-PublishedEvent.git` directly into your `craft/plugins` folder.  You can then update it with `git pull`
3.  -OR- install with Composer via `composer require sjelfull/publishedevent`
4. Install plugin in the Craft Control Panel under Settings > Plugins
5. The plugin folder should be named `publishedevent` for Craft to see it.  GitHub recently started appending `-master` (the branch name) to the name of the folder for zip file downloads.

Published event works on Craft 2.4.x and Craft 2.5.x.

### Checking for published elements

To check for any elements that has been published, you have to run either the console command or controller action at the interval you need, for example from a cron job.

Run `./craft/app/etc/console/yiic publishedEvent` OR

 Make a request to the action `publishedEvent/check`:

  `curl --silent http://example.com/actions/publishedEvent/check`

### The `publishedEvent.onPublished` event

Other plugins can be notified when a pending entry has been published.

```php
class SomePlugin extends BasePlugin
{
    // ...

    public function init()
    {
        craft()->on('publishedEvent.onPublished', function (PublishedEvent $event) {
            $entry = $event->params['entry'];

            // Do something with the $entry
        });
    }
}
```

## Published event Changelog

### 1.0.1 -- 2017.03.05

* Added console command
* Renamed checkElements action to check

### 1.0.0 -- 2017.03.04

* Initial release

Brought to you by [Fred Carlsen](http://sjelfull.no)
