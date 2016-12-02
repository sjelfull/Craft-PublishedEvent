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

class PublishedEventRecord extends BaseRecord
{
    /**
     * @return string
     */
    public function getTableName ()
    {
        return 'publishedevents';
    }

    /**
     * @access protected
     * @return array
     */
    protected function defineAttributes ()
    {
        return array(
            'enableDate' => array( AttributeType::DateTime, 'default' => null ),
        );
    }

    /**
     * @inheritDoc BaseRecord::defineRelations()
     *
     * @return array
     */
    public function defineRelations ()
    {
        return array(
            'element' => array( static::BELONGS_TO, 'ElementRecord', 'elementId', 'required' => true, 'onDelete' => static::CASCADE ),
        );
    }
}