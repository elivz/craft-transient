<?php
/**
 * Transient plugin for Craft CMS 3.x
 *
 * Store variables in Twig code which will be available to other templates for 
 * the duration of the page load.
 *
 * @copyright 2019 Eli Van Zoeren
 * @link      https://elivz.com
 */

namespace elivz\transient\twigextensions;

use elivz\transient\Transient;

use Craft;

/**
 * Twig can be extended in many ways; you can add extra tags, filters, tests, 
 * operators, global variables, and functions. You can even extend the parser 
 * itself with node visitors.
 *
 * @package Transient
 * @author  Eli Van Zoeren <eli@elivz.com>
 * @since   1.0.0
 */
class TransientTwigExtension extends \Twig_Extension
{
    // Public Methods
    // =========================================================================

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'Transient';
    }

    /**
     * Returns an array of Twig functions, used in Twig templates via:
     *
     *      {% do set_transient('key', data) %}
     *
    * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('set_transient', [$this, 'set']),
            new \Twig_SimpleFunction('append_transient', [$this, 'append']),
            new \Twig_SimpleFunction('increment_transient', [$this, 'increment']),
            new \Twig_SimpleFunction('get_transient', [$this, 'get']),
        ];
    }

    /**
     * Store a piece of data
     *
     * @param string|int $key  The cache key to save to
     * @param mixed      $data Whatever data should be saved
     * 
     * @return void
     */
    public function set($key, $data)
    {
        Transient::$plugin->transientService->set($key, $data);
    }

    /**
     * Append a piece of data
     *
     * @param string|int   $key  The cache key to save to
     * @param string|array $data Whatever data should be appended
     * 
     * @return void
     */
    public function append($key, $data)
    {
        Transient::$plugin->transientService->append($key, $data);
    }

    /**
     * Increment a counter
     *
     * @param string|int $key  The cache key to save to
     * @param int        $step Amount to increase the counter
     * 
     * @return void
     */
    public function increment($key, $step = 1)
    {
        Transient::$plugin->transientService->increment($key, $step);
    }

    /**
     * Retrieve a piece of data
     *
     * @param string|int $key     The cache key to get
     * @param mixed      $default A default value in case there is nothing stored
     * 
     * @return mixed
     */
    public function get($key, $default = false)
    {
        return Transient::$plugin->transientService->get($key, $default);
    }
}
