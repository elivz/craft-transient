<?php
/**
 * Transient plugin for Craft CMS 3.x
 *
 * Store variables in Twig code which will be available to other templates for the duration of the page load.
 *
 * @copyright 2019 Eli Van Zoeren
 * @link      https://elivz.com
 */

namespace elivz\transient;

use elivz\transient\services\TransientService as TransientService;
use elivz\transient\variables\TransientVariable;
use elivz\transient\twigextensions\TransientTwigExtension;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

/**
 * @package Transient
 * @author  Eli Van Zoeren <eli@elivz.com>
 * @since   1.0.0
 *
 * @property  TransientService $transientService
 */
class Transient extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * Static property that is an instance of this plugin class so that it can be accessed via
     * Transient::$plugin
     *
     * @var Transient
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * To execute your plugin’s migrations, you’ll need to increase its schema version.
     *
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * Set our $plugin static property to this class so that it can be accessed via
     * Transient::$plugin
     *
     * Called after the plugin class is instantiated; do any one-time initialization
     * here such as hooks and events.
     *
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // Add in our Twig extensions
        Craft::$app->view->registerTwigExtension(new TransientTwigExtension());

        // Register our variables
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                $variable = $event->sender;
                $variable->set('transient', TransientVariable::class);
            }
        );
    }
}
