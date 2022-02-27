# KFinalize

KFinilize registers a script shutdown callbacks for finalization purposes. It's mostly useful in KPHP (or hybrid) applications,
where you want to free some resources allocated outside of the KPHP memory context (FFI code is one of the examples). 

When using multiple FFI libraries, you can at some point reach the max [register_shutdown_function](https://www.php.net/manual/en/function.register-shutdown-function.php) stack depth and your script will fail. To avoid that, KFinalize tries to aggregate all finalization needs and combine them into one shutdown callback.

Some users of this library:

* [KSQLite](https://github.com/quasilyte/KSQLite) - a FFI-based SQLite library that can be used in both PHP and KPHP
