<?php

namespace justcoded\yii2\eventlistener\observers;

/**
 * Class Observer
 *
 * @package justcoded\yii2\eventlistener\observers
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
