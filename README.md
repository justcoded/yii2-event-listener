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
 * Class Listener
 *
 * @package justcoded\yii2\eventlistener\listeners
 */
class UserListener extends Listener
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
		
		// TODO: write your code here.
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
				\app\models\User::EVENT_AFTER_UPDATE => \app\listeners\UserListener::class,
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
namespace app\listeners;

use app\models\User;
use justcoded\yii2\eventlistener\observers\ActiveRecordObserver;
use justcoded\yii2\eventlistener\observers\Observer;
use yii\base\Event;
use yii\base\ModelEvent;
use yii\db\AfterSaveEvent;

/**
 * Class Listener
 *
 * @package justcoded\yii2\eventlistener\listeners
 */
class UserObserver extends Observer
{
	public function events()
	{
		return [
			User::EVENT_AFTER_UPDATE => 'updated',
		];
	}

	/**
	 * Handle action on event trigger.
	 *
	 * @param Event $event
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

