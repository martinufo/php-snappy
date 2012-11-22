php-snappy
==========

Fork of http://code.google.com/p/php-snappy.

This repository is intended to provide a better documentation to simplify use of the
[snappy](http://code.google.com/p/snappy/) API with [PHP](http://www.php.net).

Installation
------------

You need the snappy headers installed before compiling the extension.
Most distributions should supply a `libsnappy-dev` and a `libsnappy1`.

PHP 5 is required.

```
git clone git://github.com/goatherd/php-snappy.git
cd php-snappy
phpize
./configure
make & make test & make install
```

Add `extension=snappy.so` to your php.ini.

On Debian/ Ubuntu and similar distributions you may want to add a `/etc/php5/conf.d/snappy.ini` for that purpose.

Usage
-----

```php
/**
 * Compress using snappy.
 *
 * @param string $data data to compress
 *
 * @return string  compressed data
 *         boolean false on error (and E_WARNING with further detail)
 */  
snappy_compress($data);

/**
 * Uncompress using snappy.
 * 
 * @param string $data compressed data
 *
 * @return string  uncompressed data
 *         boolean false on error (and E_WARNING with further detail)
 */
snappy_uncompress($data)
```

Note that integer data will be casted to string and boolean/ null will result in `\000`.

See `examples\snappy.php` for a demo CLI tool (do not use for production).

Description
-----------

Snappy was developed to reduce network traffic with neglectable overhead on the node.
It is therefor quiet fast (to decompress) with a reasonable compression ratio. The developer states [2-4x for HTML data](http://code.google.com/p/snappy/source/browse/trunk/README) for example.
Note that snappy is optimised for 64bit architectures and speed benchmarks are usally supplied for that.

At the time of writing no streaming service is known to use snappy on the fly.

With PHP it is possible to couple snappy with memcached services. But beware of the decompression times on serialised php data.
Combined with [igbinary](http://pecl.php.net/package/igbinary) it seems to provide acceptable performance and compression ratio.

More convention use cases involve message queues and data streams.


TODO
----

* a real [PECL](http://pecl.php.net) setup would be nice.
* link use case and bench statistics for PHP
