<?php

namespace justcoded\yii2\eventlistener\listeners;

use yii\base\Event;

/**
 * Class Listener
 *
 * @package justcoded\yii2\eventlistener\listeners
 */
abstract class Listener
{
	/**
	 * Handle action on event trigger.
	 *
	 * @param Event $event
	 *
	 * @return void
	 */
	abstract public function handle(Event $event);
}
