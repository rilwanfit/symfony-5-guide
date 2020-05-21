## Dependency Injection

The container is basically an associative array which holds service objects.

```php
$obj = $container->get('name');
```

### Create a container in a php class



### Don't create service in container; teach the container



### How to find available services that we can autowire
```bash
bin/console debug:autowiring
```

### How to find all possible services?
```bash
bin/console debug:container
```

### How services automatically loads?
check the configuration file [here](https://github.com/rilwanfit/symfony-5-learning/blob/94e132bba9125b56eb46d35936e86dacdcd99f76/config/services.yaml#L8)


### How to Manage Common Dependencies with Parent Services

For example, you may have multiple repository classes which need the `doctrine.orm.entity_manager` service and an optional logger service:

in this case we can use PHP inheritance to avoid duplication in your PHP code. similarly we need to think about avoiding duplicated service definitions in the service container.

This can be done via the usage of `parent` and `abstract` keys

> Note 01: All attributes on the parent service are shared with the child except for `shared`, `abstract` and `tags`. These are not inherited from the parent.

> Note 02: If you have a _defaults section in your file, all child services are required to explicitly override those values to avoid ambiguity. You will see a clear error message about this.

> Note 03: a service cannot have a "parent" and also have "autoconfigure" to be true.

code: https://github.com/rilwanfit/symfony-5-learning/commit/efc8bf0915e818b7bcfd262a774f18bc62601b16


