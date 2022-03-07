# CHANGELOG

## [4.1.0](https://github.com/softspring/core-bundle/releases/tag/4.1.0) (07 mar 2022)

### Upgrading

The *sfs_core.locales* configuration has been deprecated, please use symfony framework.enabled_locales and access to it as %kernel.enabled_locales%. 

### Commits

- d2fb6d8 Remove dev version in composer.json file
- adf0b98 Use framework enabled_locales
- c1c43f9 Configure new 4.1-dev version to main branch in composer.json file
- c9bb912 Remove dev version in composer.json file

### Changes

 src/DependencyInjection/Configuration.php | 1 +
 1 file changed, 1 insertion(+)
