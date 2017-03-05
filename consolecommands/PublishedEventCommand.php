<?php
/**
 * Published event plugin for Craft CMS
 *
 * PublishedEvent Record
 *
 * @author    Fred Carlsen
 * @copyright Copyright (c) 2016 Fred Carlsen
 * @link      http://sjelfull.no
 * @package   PublishedEvent
 * @since     1.0.0
 */

namespace Craft;

class PublishedEventCommand extends BaseCommand
{
    public function actionIndex ()
    {
        $this->check();
    }

    public function actionCheck ()
    {
        echo "Checking for any pending entries";
        $existingRecords = craft()->publishedEvent->check();

        echo count($existingRecords) . "entries waiting to be published";
    }
}