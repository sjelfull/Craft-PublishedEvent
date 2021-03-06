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
    public function actionCheck ()
    {
        $existingRecords = craft()->publishedEvent->check();

        $this->returnJson($existingRecords);
    }
}