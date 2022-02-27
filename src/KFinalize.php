<?php

namespace KFinalize;

class KFinalize {
  private static bool $registered = false;

  /** @var (callable():void)[] */
  private static $func_map = [];

  /** @var (callable():void)[] */
  private static $func_list = [];

  /**
   * push() is used to add a non-removable entry to the callbacks list.
   * @param callable():void $fn
   */
  public static function push(callable $fn) {
    self::ensure_registered();
    self::$func_list[] = $fn;
  }

  /**
   * add() binds a callback to a given key.
   * It can later be unbound by calling remove on the same key.
   * @param string|int $key
   * @param callable():void $fn
   */
  public static function add($key, callable $fn) {
    self::ensure_registered();
    self::$func_map[$key] = $db;
  }

  /**
   * remove() removes previously bound callback for a given key.
   * @param string|int $key
   */
  public static function remove($key) {
    unset(self::$func_map[$key]);
  }

  private static function ensure_registered() {
    if (!self::$registered) {
      self::register();
    }
  }

  private static function register() {
    self::$registered = true;
    register_shutdown_function(function() {
      foreach (self::$func_list as $fn) {
        $fn();
      }
      foreach (self::$func_map as $fn) {
        $fn();
      }
    });
  }
}
