<?php

namespace Drupal\drupalauth4ssp;

use Drupal\Core\Config\ConfigFactoryInterface;
use SimpleSAML\Configuration as SimpleSAMLConfiguration;
use SimpleSAML\Utils\Config as SimpleSAMLConfig;

/**
 * Config service.
 */
class Config {

  /**
   * Cookie name.
   *
   * @var string
   */
  private $cookie_name;

  /**
   * List of allowed URLs.
   *
   * @var string
   */
  private $returnto_list;

  /**
   * SimpleSAMLphp secret salt.
   *
   * @var string
   */
  private $secret_salt;

  /**
   * SimpleSAMLphp base path
   *
   * @var string
   */
  private $base_path;

  /**
   * Constructs a config object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $config = $config_factory->get('drupalauth4ssp.settings');
    $this->cookie_name = $config->get('cookie_name');;
    $this->returnto_list = $config->get('returnto_list');;

    // Get the secretsalt.
    $this->secret_salt = SimpleSAMLConfig::getSecretSalt();

    // Get the baseurlpath.
    $this->base_path = SimpleSAMLConfiguration::getInstance()->getBasePath();
  }

  /**
   * Returns cookie name.
   *
   * @return string
   */
  public function getCookieName() {
    return $this->cookie_name;
  }

  /**
   * Returns allowed "return to" list.
   *
   * @return string
   */
  public function getReturnToList() {
    return $this->returnto_list;
  }

  /**
   * Returns secret salt.
   *
   * @return string
   */
  public function getSecretSalt() {
    return $this->secret_salt;
  }

  /**
   * Returns base path.
   *
   * @return string
   */
  public function getBasePath() {
    return $this->base_path;
  }

}
