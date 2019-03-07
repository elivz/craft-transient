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

namespace elivz\transient\variables;

use elivz\transient\Transient;

use Craft;

/**
 * Transient Variable
 *
 * Craft allows plugins to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.transient }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @package Transient
 * @author  Eli Van Zoeren <eli@elivz.com>
 * @since   1.0.0
 */
class TransientVariable
{
    // Public Methods
    // =========================================================================

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
     * @param string|array $data Whatever data should be saved
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
