<?php

namespace justcoded\yii2\eventlistener\listeners;

use yii\base\Event;

/**
 * Class EventListener
 *
 * @package justcoded\yii2\eventlistener\components
 */
abstract class Observer
{
	/**
	 * Return a list of events and corresponding methods.
	 *
	 * Example:
	 * return [
	 * 	   ActiveRecord::EVENT_AFTER_INSERT => 'inserted',
	 * ]
	 *
	 * @return array
	 */
	abstract public function events();
}
