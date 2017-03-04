<?php
/**
 * Published event plugin for Craft CMS
 *
 * PublishedEvent Service
 *
 * @author    Fred Carlsen
 * @copyright Copyright (c) 2016 Fred Carlsen
 * @link      http://sjelfull.no
 * @package   PublishedEvent
 * @since     1.0.0
 */

namespace Craft;

class PublishedEventService extends BaseApplicationComponent
{
    /**
     * Fires an 'onPublished' event.
     *
     * @param PublishedEvent $event
     */
    public function onPublished (PublishedEvent $event)
    {
        $this->raiseEvent('onPublished', $event);
    }

}