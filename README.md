RedisBrowserBundle
==================

Symfony2 - Browser for the Redis key-value storage.



Installation
============

### Step 1: Download the 'FilthRedisBrowserBundle'

Ultimately, the FilthRedisBrowserBundle files should be downloaded to the
'vendor/bundles/Filth/RedisBrowserBundle' directory.

You can accomplish this several ways, depending on your personal preference.
The first method is the standard Symfony2 method.

***Using the vendors script***

Add the following lines to your `deps` file:

```
    [FilthRedisBrowserBundle]
        git=https://github.com/filthz/RedisBrowserBundle.git
        target=/bundles/Filth/RedisBrowserBundle
```

Now, run the vendors script to download the bundle:

``` bash
$ php bin/vendors install
```

***Using submodules***

If you prefer instead to use git submodules, then run the following:

``` bash
$ git submodule add git://github.com/filthz/RedisBrowserBundle.git vendor/bundles/Filth/RedisBrowserBundle
$ git submodule update --init
```

### Step 2: Configure the Autoloader

Now you will need to add the `Filth` namespace to your autoloader:

``` php
<?php
// app/autoload.php

$loader->registerNamspaces(array(
    // ...
    'Filth' => __DIR__.'/../vendor/bundles',
));
```
### Step 3: Enable the bundle

Finally, enable the bundle in the kernel:

```php
<?php
// app/appKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Filth\RedisBrowserBundle\FilthRedisBrowserBundle(),
    );
}
```

### Step 4: Add Routing

```yml
// app/routing.yml

_filth_redis_browser_index:
    pattern:  /redis
    defaults: { _controller: FilthRedisBrowserBundle:RedisBrowser:index }

_filth_redis_browser_show:
    pattern:  /redis/{key}/{clientid}/show
    defaults: { _controller: FilthRedisBrowserBundle:RedisBrowser:show }
````    

You can adapt the routing to suit your needs.

### Step 5: Register redis Clients

Now you need to make the 'FilthRedisBrowserBundle' know, which Redis Clients it should monitor.

```yml
// app/config.yml

filth_redis_browser:
   clients:
       - { alias: snc_redis.default_client }
```

Alias is the name of the service, where the Redis client is avaible. The bundle will make a call to this service and work with the client from that.

We are done! Open /redis url in your browser and enjoy.


- [Overriding Templates](overriding_templates.md)





        