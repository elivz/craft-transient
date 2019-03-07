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

namespace elivz\transient\services;

use elivz\transient\Transient;

use Craft;
use craft\base\Component;

/**
 * TransientService Service
 *
 * @package Transient
 * @author  Eli Van Zoeren <eli@elivz.com>
 * @since   1.0.0
 */
class TransientService extends Component
{
    // Protected Variables
    // =========================================================================

    /**
     * This is where we store our data
     */
    protected $data = [];


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
        if (is_string($key) or is_integer($key)) {
            $this->data[$key] = $data;
        }
    }

    /**
     * Append a variable to an existing item
     *
     * @param string|int   $key  The cache key to save to
     * @param string|array $data Whatever data should be appended
     * 
     * @return void
     */
    public function append($key, $data)
    {
        if (is_string($key) or is_integer($key)) {
            if (empty($this->data[$key])) {
                $this->data[$key] = $data;
            } elseif (is_array($this->data[$key])) {
                if (is_array($data)) {
                    $this->data[$key] = array_merge($this->data[$key], $data);
                } else {
                    $this->data[$key][] = $data;
                }
            } elseif (is_string($this->data[$key]) || is_numeric($this->data[$key])) {
                if (is_string($data) || is_numeric($data)) {
                    $this->data[$key] .= $data;
                }
            }
        }
    }

    /**
     * Increment a numeric counter
     *
     * @param string|int $key  The cache key to save to
     * @param int        $step Amount to add
     * 
     * @return void
     */
    public function increment($key, $step = 1)
    {
        if (is_string($key) or is_integer($key)) {
            if (empty($this->data[$key])) {
                $this->data[$key] = $step;
            } elseif (is_numeric($this->data[$key])) {
                $this->data[$key] += $step;
            }
        }
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
        if (!isset($this->data[$key])) {
            return $default;
        }
        
        return $this->data[$key];
    }
}
