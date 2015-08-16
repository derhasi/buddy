<?php

namespace derhasi\buddy\Config;

use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Yaml\Yaml;

class YamlLoader extends FileLoader
{
  /**
   * {@inheritdoc}
   */
  public function load($resource, $type = null)
  {
    return Yaml::parse($resource);
  }

  /**
   * {@inheritdoc}
   */
  public function supports($resource, $type = null)
  {
    return is_string($resource) && 'yml' === pathinfo(
      $resource,
      PATHINFO_EXTENSION
    );
  }
}