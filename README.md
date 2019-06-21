<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii2 Event Listener</h1>
    <br>
</p>

Simple event listeners registration component and view abstract classes to implement Linstener or Observer.

### Installation

The preferred way to install this extension is through composer.

Either run

```bash
php composer.phar require --prefer-dist justcoded/yii2-event-listener "*"
```

or add

```
"justcoded/yii2-event-listener": "*"
```

to the require section of your composer.json.

### Configuration

### Component Setup

To use the Event Listener Component, you need to configure the components array in your application configuration:

```php
'components' => [
    'listener' => [
        'class'     => \justcoded\yii2\eventlistener\components\EventListener::class,
        'listeners' => [
        	...
        ],
        'observers' => [
        	...
        ],
    ],
],
```

and add component name to bootstrap array

```php
    'bootstrap'  => ['log', 'listener'],
```

### Usage

#### Listeners

**Listener** is a single action, which can be performed on some event. To register a listener you need to create a simple class:

```php
<?php
namespace app\listeners;

use justcoded\yii2\eventlistener\listeners\Listener;
use yii\base\Event;

/**
 * Class SendUserGreeting
 */
class SendUserGreeting extends Listener
{
	/**
	 * Handle action on event trigger.
	 *
	 * @param Event $event
	 *
	 * @return void
	 */
	public function handle(Event $event)
	{
		/* @var \app\models\User $sender */
		$sender = $event->sender;
		
		// TODO: write your code here, for example, send user greeting email after it was registered or created.
	}
}

```

After that you need to register it within a component inside 'listeners' config array:

```php
'components' => [
    'listener' => [
        'class'     => \justcoded\yii2\eventlistener\components\EventListener::class,
        'listeners' => [
        	\app\models\User::class => [
				\app\models\User::EVENT_AFTER_INSERT => \app\listeners\SendUserGreeting::class,
			],
        ],
    ],
],
```

#### Observers

Observer is a class, which can subscribe to several events of the same model. To create an 
Observer you need to extend it from a basic Observer class and create `events()` method and methods to 
handle these events. 

Example:

```php
<?php
namespace app\observers;

use app\controllers\SiteController;
use justcoded\yii2\eventlistener\observers\Observer;
use yii\base\Event;

/**
 * Class UserObserver
 */
class SiteControllerObserver extends Observer
{
	public function events()
	{
		return [
			SiteController::EVENT_BEFORE_ACTION => 'before',
			SiteController::EVENT_AFTER_ACTION => 'after',
		];
	}

	/**
	 * Handle before action event
	 *
	 * @param Event $event
	 *
	 * @return void
	 */
	public function before(Event $event)
	{
		/* @var SiteController $sender */
		$sender = $event->sender;
		
		// TODO: write your code here.
	}

	/**
	 * Handle after action event
	 *
	 * @param Event $event
	 *
	 * @return void
	 */
	public function after(Event $event)
	{
		/* @var SiteController $sender */
		$sender = $event->sender;
		
		// TODO: write your code here.
	}	
}
```

After that you need to register it within a component inside 'observers' config array:

```php
'components' => [
    'listener' => [
        'class'     => \justcoded\yii2\eventlistener\components\EventListener::class,
        'observers' => [
        	app\controllers\SiteController::class => \app\observers\SiteControllerObserver::class,
        	app\models\User::class => \app\observers\UserObserver::class,
        ],
    ],
],
```

##### ActiveRevordObserver

Package also contains a specific class called ActiveRecordObserver. 
This class already declared all ActiveRecord events an methods to process them:

* inserting()
* inserted()
* updating()
* updated()
* deleting()
* deleted()
* validating()
* validated()
* refreshed()
* initialized()

Example:

```php
<?php
namespace app\observers;

use justcoded\yii2\eventlistener\observers\ActiveRecordObserver;
use yii\db\AfterSaveEvent;

/**
 * Class UserObserver
 */
class UserObserver extends ActiveRecordObserver
{
	/**
	 * Handle AFTER_UPDATE ActiveRecord event.
	 *
	 * @param AfterSaveEvent $event
	 *
	 * @return void
	 */
	public function updated(AfterSaveEvent $event)
	{
		/* @var \app\models\User $sender */
		$sender = $event->sender;
		
		// TODO: write your code here.
	}
}

```