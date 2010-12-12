<?php

/**
 * W3 Total Cache plugins API
 */

/**
 * Add W3TC action callback
 *
 * @param string $action
 * @param mixed $callback
 * @return void
 */
function w3tc_add_action($action, $callback) {
    $GLOBALS['_w3tc_actions'][$action][] = $callback;
}

/**
 * Do W3TC action
 *
 * @param string $action
 * @param mixed $value
 * @return mixed
 */
function w3tc_do_action($action, $value = null) {
    if (isset($GLOBALS['_w3tc_actions'][$action])) {
        foreach ((array) $GLOBALS['_w3tc_actions'][$action] as $callback) {
            if (is_callable($callback)) {
                $value = call_user_func($callback, $value);
            }
        }
    }

    return $value;
}

/**
 * Shortcut for page cache flush
 *
 * @return boolean
 */
function w3tc_pgcache_flush() {
    require_once W3TC_LIB_W3_DIR . '/PgCache.php';

    $w3_pgcache = & W3_PgCache::instance();

    return $w3_pgcache->flush();
}

/**
 * Shortcut for page post cache flush
 *
 * @param integer $post_id
 * @return boolean
 */
function w3tc_pgcache_flush_post($post_id) {
    require_once W3TC_LIB_W3_DIR . '/PgCache.php';

    $w3_pgcache = & W3_PgCache::instance();

    return $w3_pgcache->flush_post($post_id);
}

/**
 * Shortcut for database cache flush
 *
 * @return boolean
 */
function w3tc_dbcache_flush() {
    require_once W3TC_LIB_W3_DIR . '/Db.php';

    $w3_db = & W3_Db::instance();

    return $w3_db->flush_cache();
}

/**
 * Shortcut for minify cache flush
 *
 * @return boolean
 */
function w3tc_minify_flush() {
    require_once W3TC_LIB_W3_DIR . '/Minify.php';

    $w3_minify = & W3_Minify::instance();

    return $w3_minify->flush();
}

/**
 * Shortcut for objectcache cache flush
 *
 * @return boolean
 */
function w3tc_objectcache_flush() {
    require_once W3TC_LIB_W3_DIR . '/ObjectCache.php';

    $w3_objectcache = & W3_ObjectCache::instance();

    return $w3_objectcache->flush();
}

/**
 * Prints script link for scripts group
 *
 * @param string $location
 * @param string $group
 */
function w3tc_scripts($location, $group = null) {
    require_once W3TC_LIB_W3_DIR . '/Plugin/Minify.php';

    $w3_plugin_minify = & W3_Plugin_Minify::instance();
    $w3_plugin_minify->printed_scripts[] = $location;

    echo $w3_plugin_minify->get_scripts($location, $group);
}

/**
 * Prints style link for styles group
 *
 * @param string $location
 * @param string $group
 */
function w3tc_styles($location, $group = null) {
    require_once W3TC_LIB_W3_DIR . '/Plugin/Minify.php';

    $w3_plugin_minify = & W3_Plugin_Minify::instance();
    $w3_plugin_minify->printed_styles[] = $location;

    echo $w3_plugin_minify->get_styles($location, $group);
}
