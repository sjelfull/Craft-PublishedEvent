<?php
/**
 * Published event plugin for Craft CMS
 *
 * Triggers a event for elements that was enabled at a given time.
 *
 * @author    Fred Carlsen
 * @copyright Copyright (c) 2016 Fred Carlsen
 * @link      http://sjelfull.no
 * @package   PublishedEvent
 * @since     1.0.0
 */

namespace Craft;

class PublishedEventPlugin extends BasePlugin
{
    /**
     * @return mixed
     */
    public function init ()
    {
        parent::init();

        Craft::import('plugins.publishedevent.events.PublishedEvent');
    }

    /**
     * @return mixed
     */
    public function getName ()
    {
        return Craft::t('Published Event');
    }

    /**
     * @return mixed
     */
    public function getDescription ()
    {
        return Craft::t('Triggers a event for elements that was enabled at a given time.');
    }

    /**
     * @return string
     */
    public function getDocumentationUrl ()
    {
        return 'https://github.com/sjelfull/publishedevent/blob/master/README.md';
    }

    /**
     * @return string
     */
    public function getReleaseFeedUrl ()
    {
        return 'https://raw.githubusercontent.com/sjelfull/Craft-PublishedEvent/master/releases.json';
    }

    /**
     * @return string
     */
    public function getVersion ()
    {
        return '1.0.2';
    }

    /**
     * @return string
     */
    public function getSchemaVersion ()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getDeveloper ()
    {
        return 'Fred Carlsen';
    }

    /**
     * @return string
     */
    public function getDeveloperUrl ()
    {
        return 'http://superbig.co';
    }
}