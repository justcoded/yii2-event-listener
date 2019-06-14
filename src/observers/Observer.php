<?php

namespace justcoded\yii2\eventlistener\observers;

use yii\base\Event;

/**
 * Class ActiveRecordObserver
 *
 * @package justcoded\yii2\eventlistener\observers
 */
class ActiveRecordObserver
{
	/**
	 * Return a list of events and corresponding methods.
	 *
	 * Example:
	 * return [
	 *       ActiveRecord::EVENT_AFTER_INSERT => 'inserted',
	 * ]
	 *
	 * @return array
	 */
	public function events()
	{
		return [
			'EVENT_AFTER_FIND'      => 'found',
			'EVENT_AFTER_INSERT'    => 'inserted',
			'EVENT_AFTER_UPDATE'    => 'updated',
			'EVENT_AFTER_VALIDATE'  => 'validated',
			'EVENT_AFTER_REFRESH'   => 'refreshed',
			'EVENT_AFTER_DELETE'    => 'deleted',
			'EVENT_BEFORE_INSERT'   => 'inserting',
			'EVENT_BEFORE_UPDATE'   => 'updating',
			'EVENT_BEFORE_VALIDATE' => 'validating',
			'EVENT_BEFORE_DELETE'   => 'deleting',
			'EVENT_INIT'            => 'initialized',
		];
	}

	public function found(Event $event)
	{
	}

	public function inserted(\yii\db\AfterSaveEvent $event)
	{
	}

	public function updated(\yii\db\AfterSaveEvent $event)
	{
	}

	public function validated(\yii\base\ModelEvent $event)
	{
	}

	public function deleted(\yii\base\ModelEvent $event)
	{
	}

	public function refreshed(\yii\base\ModelEvent $event)
	{
	}

	public function inserting(\yii\base\ModelEvent $event)
	{
	}

	public function updating(\yii\base\ModelEvent $event)
	{
	}

	public function validating(\yii\base\ModelEvent $event)
	{
	}

	public function deleting(\yii\base\ModelEvent $event)
	{
	}

	public function initialized(\yii\base\ModelEvent $event)
	{
	}
}
