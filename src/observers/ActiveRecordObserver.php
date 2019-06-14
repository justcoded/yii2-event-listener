<?php

namespace justcoded\yii2\eventlistener\observers;

use yii\db\ActiveRecord;

/**
 * Class ActiveRecordObserver
 *
 * @package justcoded\yii2\eventlistener\observers
 */
class ActiveRecordObserver extends Observer
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
			ActiveRecord::EVENT_AFTER_FIND      => 'found',
			ActiveRecord::EVENT_AFTER_INSERT    => 'inserted',
			ActiveRecord::EVENT_AFTER_UPDATE    => 'updated',
			ActiveRecord::EVENT_AFTER_VALIDATE  => 'validated',
			ActiveRecord::EVENT_AFTER_REFRESH   => 'refreshed',
			ActiveRecord::EVENT_AFTER_DELETE    => 'deleted',
			ActiveRecord::EVENT_BEFORE_INSERT   => 'inserting',
			ActiveRecord::EVENT_BEFORE_UPDATE   => 'updating',
			ActiveRecord::EVENT_BEFORE_VALIDATE => 'validating',
			ActiveRecord::EVENT_BEFORE_DELETE   => 'deleting',
			ActiveRecord::EVENT_INIT            => 'initialized',
		];
	}

	public function found(\yii\base\Event $event)
	{
	}

	public function inserted(\yii\db\AfterSaveEvent $event)
	{
	}

	public function updated(\yii\db\AfterSaveEvent $event)
	{
	}

	public function validated(\yii\base\Event $event)
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

	public function initialized(\yii\base\Event $event)
	{
	}
}
