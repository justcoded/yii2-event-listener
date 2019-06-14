<?php

namespace justcoded\yii2\eventlistener\components;

use app\models\User;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\Event;
use yii\base\Model;

/**
 * Class EventListener
 *
 * @package justcoded\yii2\eventlistener\components
 */
class EventListener extends Component implements EventListenerInterface, BootstrapInterface
{
	/**
	 * Events and Listeners match array
	 *
	 * Config example
	 *
	 * \app\models\User::class => [
	 *        User::EVENT_AFTER_INSERT => \app\listeners\UserInserted::class
	 *        User::EVENT_AFTER_UPDATE => [
	 *            \app\listeners\UserUpdated::class,
	 *            \app\listeners\EntityUpdated::class,
	 *        ],
	 * ],
	 *
	 * @var array
	 */
	public $listeners = [];

	/**
	 * Specify objects to be observed by observer classes.
	 *
	 * Config example
	 *
	 * \app\models\User::class => \app\listeners\UserObserver::class,
	 * \app\models\User::class => [\app\listeners\UserObserver::class, ... ],
	 *
	 * @var array
	 */
	public $observers;

	/**
	 * Bootstrap method to be called during application bootstrap stage.
	 *
	 * @param Application $app the application currently running
	 */
	public function bootstrap($app)
	{
		$container = \Yii::$container;
		$container->setSingleton(EventListenerInterface::class, $this);
	}

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		$this->initListeners();
		$this->initObservers();
	}

	/**
	 * Normalize Config Array
	 * check value to be array, index values with the same value string
	 *
	 * @param $array
	 */
	protected function normalizeConfig($array)
	{
		foreach ($array as $key => $value) {
			if (! is_array($value)) {
				$value = [$value];
			}

			$array[$key] = array_combine($value, $value);
		}
	}

	/**
	 * Create listener classes and match them to an events based on $this->listeners configuration array.
	 */
	protected function initListeners()
	{
		// normalize config array.
		foreach ($this->listeners as $watchedName => $listeners) {
			$this->listeners[$watchedName] = $this->normalizeConfig($listeners);
		}

		// init events.
		foreach ($this->listeners as $watchedName => $modelEvents) {
			foreach ($modelEvents as $eventName => $listeners) {
				foreach ($listeners as $listenerClass) {
					$listener = new $listenerClass();
					Event::on($watchedName, $eventName, [$listener, 'handle']);

					$this->listeners[$watchedName][$eventName][$listenerClass] = $listener;
				}
			}
		}
	}

	/**
	 * Create observer classes and match them to an events based on $this->observers configuration array.
	 */
	protected function initObservers()
	{
		$this->observers = $this->normalizeConfig($this->observers);

		foreach ($this->observers as $className => $observers) {
			foreach ($observers as $observerClass) {
				$observer = new $observerClass();
				$events = $observer->events();

				foreach ($events as $eventName => $methodName) {
					Event::on($className, $eventName, [$observer, $methodName]);
				}

				$this->observers[$className][$observerClass] = $observer;
			}
		}
	}

}
