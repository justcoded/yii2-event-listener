<?php

namespace justcoded\yii2\eventlistener\components;

/**
 * Interface EventListenerInterface
 *
 * @package justcoded\yii2\eventlistener\components
 */
interface EventListenerInterface
{
	/**
	 * Create listener classes and match them to an events based on $this->listeners configuration array.
	 */
	protected function initListeners();

	/**
	 * Create observer classes and match them to an events based on $this->observers configuration array.
	 */
	protected function initObservers();
}
