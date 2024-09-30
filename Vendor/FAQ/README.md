# Mage2 Module Vendor FAQ

    ``vendor/module-faq``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
Modulo para gestionar preguntas frecuentes

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Vendor`
 - Enable the module by running `php bin/magento module:enable Vendor_FAQ`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require vendor/module-faq`
 - enable the module by running `php bin/magento module:enable Vendor_FAQ`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration




## Specifications

- Controller
  - frontend > vendor_faq/index/index

 - Model
   - FAQ


    
- Se puede acceder a la parte pública (frontend) desde la ruta:  
  - <domain>/vendor_faq
- Se puede encontrar el crud desde el menú principal del admin en 2 lugares 
  - Content > FAQ > Manage FAQs 
  - Vendor > Content > Manage FAQs
- Puedes encontrar extras como
  - Apartado en store > configuration > Vendor
  - ACL
  - Algunas rutas API
  - Archivos de idiomas

## Attributes



