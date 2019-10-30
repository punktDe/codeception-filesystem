# punktde/codeception-filesystem

## Gherkin Steps and additional module functions for the Codeception Filesystem module

### How to use

#### Extended module

Use the module `PunktDe\Codeception\Filesystem\Module\Filesystem` instead of the default codeception module `filesystem` in your `codeception.yaml`:

```
modules:
   enabled:
      - PunktDe\Codeception\Filesystem\Module\Filesystem
```


#### Gherkin steps

Just add the trait `PunktDe\Codeception\Filesystem\ActorTraits\Filesystem` to your testing actor. Then you can use `*.feature` files to write your gherkin tests with the new steps.

##### Example actor 

```
<?php

/*
 *  (c) 2018 punkt.de GmbH - Karlsruhe, Germany - http://punkt.de
 *  All rights reserved.
 */

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;
    use \PunktDe\Codeception\Filesystem\ActorTraits\Filesystem; // use the filesystem steps trait
}
``` 

##### Which steps are there? 

To get all the steps available you can just run the following command:

```
vendor/bin/codecept -c path/to/codeception.yaml gherkin:steps suiteName
```

This will give you a table of all the steps available.





