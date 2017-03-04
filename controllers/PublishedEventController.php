<?php
/**
 * Published event plugin for Craft CMS
 *
 * PublishedEvent Controller
 *
 * @author    Fred Carlsen
 * @copyright Copyright (c) 2016 Fred Carlsen
 * @link      http://sjelfull.no
 * @package   PublishedEvent
 * @since     1.0.0
 */

namespace Craft;

class PublishedEventController extends BaseController
{

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     * @access protected
     */
    protected $allowAnonymous = array(
        'actionIndex',
    );

    /**
     */
    public function actionCheckElements ()
    {
        $criteria         = craft()->elements->getCriteria(ElementType::Entry);
        $criteria->status = EntryModel::PENDING;

        $pendingEntries = $criteria->find();
        $pendingIds     = $criteria->ids();

        // Get element ids of existing records
        $existingRecords = PublishedEventRecord::model()->findAll();

        // If a record exists for a entry that is enabled since last check, trigger event
        foreach ($existingRecords as $existingRecord) {

            $amongPendingEntries = in_array($existingRecord->elementId, $pendingIds);

            if ( !$amongPendingEntries ) {
                $entry = craft()->elements->getElementById($existingRecord->elementId);
                $event = new PublishedEvent($this, [ 'entry' => $entry ]);
                craft()->publishedEvent->onPublished($event);
                $existingRecord->delete();
            }
        }

        foreach ($pendingEntries as $entry) {
            $record = PublishedEventRecord::model()->findByAttributes([
                'elementId' => $entry->id,
            ]);

            if ( !$record ) {
                $dateTime = DateTimeHelper::currentTimeForDb();

                $record              = new PublishedEventRecord();
                $record->elementId   = $entry->id;
                $record->enableDate  = $entry->postDate;
                $record->dateCreated = $dateTime;
                $record->dateUpdated = $dateTime;
                $record->save();
            }
            else {
                $samePostDate = $record->enableDate === $entry->postDate;

                // Account for changed postDate?
                if ( !$samePostDate ) {
                    $record->enableDate = $entry->postDate;
                    $record->save();
                }
            }
        }

        $this->returnJson($existingRecords);
    }
}