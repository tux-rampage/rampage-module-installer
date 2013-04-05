# Composer Installer for Rampage PHP Modules

To make use of this installer add a dependency for it to your modules composer.json

The modules package type should then be set to `rampage-module`.

# Installer options

__Note__: The following options are only available in the root package.

## Modules directory

You may specify a custom modules directory for your application. Add the `rampage.modules-dir`
extras option to your project's `composer.json` file.

## Modules Config

You may also customize the location of the modules definition file. To do so add the 
`rampage.modules-config` extras option to your project's `composer.json` file. 

## Example

```json
{
    "extra": {
        "rampage": {
            "modules-dir": "application/modules",
            "modules-config": "application/etc/modules.conf"
        }
    }
}
```
 