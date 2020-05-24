## SUMMARY

The drupalauth4ssp module makes it possible for Drupal users log into a SimpleSAMLphp SAML identity provider configured
on the same virtual host as the Drupal site. It provides a tightly integrated login experience, sending unauthenticated
users to the Drupal login page to log in. As a result it removes the requirement to produce a theme for SimpleSAMLphp
since the end-user never seems any of the SimpleSAMLphp pages.

## PREREQUISITES

You must have SimpleSAMLphp installed and configured as a working identity provider (IdP).

For more information on installing and configuring SimpleSAMLphp as an IdP visit: http://www.simplesamlphp.org


## INSTALLATION

Assuming the prerequisites have been met, `composer require 'drupal/drupalauth4ssp:^1.0'`.

## CONFIGURATION

The configuration of the module is fairly straight forward - you will need to know the name of the authentication source that uses the drupalauth:External class, this is in (<simplesamlphp_path>/config/authsources.php).

## CONTACT

* Issue queue: https://drupal.org/project/issues/drupalauth4ssp
* Chat: https://drupalchat.me/channel/drupalauth4ssp


## Log out flow for single logout

### SP initiated

1. Destroys session for SP
1. Calls External::logout
1. ^ redirects to "drupal_logout_url" with ReturnTo = "http://idp-drupal8-contrib.devtools/simplesaml/module.php/core/idp/resumelogout.php?id={STATE_ID}"
1. IdP logs out rest of associated SPs
1. redirect to original SP that requested logout

### IdP initiated

1. Logout out of Drupal
1. Redirect to IdP SLS
1. Redirect to /simplesaml/module.php/core/idp/resumelogout.php?id={STATE_ID} and start logging out SPs
1. Log out from IdP
1. Redirect to ReturnTo


### TODO

1. Extend config for IdP initiated logout redirect
1. Test with some logout redirect modules
