<?php
/**
 * OneTimeCashTrait.php
 *
 * @category   GitCommand
 * @package    Git-Live
 * @subpackage Core
 * @author     akito<akito-artisan@five-foxes.com>
 * @author     suzunone<suzunone.eleven@gmail.com>
 * @copyright  Project Git Live
 * @license    MIT
 * @version    GIT: $
 * @link       https://github.com/Git-Live/git-live
 * @see        https://github.com/Git-Live/git-live
 * @since      2020/03/07
 */

namespace JapaneseDate\Components;

use Closure;

trait OneTimeCacheTrait
{
    /**
     * @var array
     */
    protected $one_time_cache = [];

    /**
     * @param string $key
     * @param \Closure $closure
     * @return mixed
     */
    protected function oneTimeCache(string $key, Closure $closure)
    {
        if (array_key_exists($key, $this->one_time_cache)) {
            return $this->one_time_cache[$key];
        }

        return $this->one_time_cache[$key] = $closure();
    }
}
