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

        $entries = $criteria->find();
        $ids     = $criteria->ids();

        // Get element ids of existing records
        $existingRecords = PublishedEventRecord::model()->findAll();

        // If a record exists for a entry that is enabled since last check, trigger event
        foreach ($existingRecords as $existingRecord) {
            // Should account for changed postDate?
            // Incase someone changes their mind and want to immediately publish
            // Setting, perhaps?
            $samePostDate = $existingRecord->enableDate === $existingRecord->element->postDate;

            if ( !in_array($existingRecord->elementId, $ids) ) {
                PublishedEventPlugin::log('Element with id ' . $existingRecord->elementId . ' has been published since last check');
            }
        }

        foreach ($entries as $entry) {
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
        }

        $this->returnJson($existingRecords);
    }
}