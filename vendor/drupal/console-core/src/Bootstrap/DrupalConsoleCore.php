<?php

/**
 * @file
 * Contains \Drupal\Console\Core\Bootstrap.
 */

namespace Drupal\Console\Core\Bootstrap;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Class DrupalConsoleCore
 * @package Drupal\Console\Core\Bootstrap
 */
class DrupalConsoleCore
{
    /**
     * @var string
     */
    protected $root;

    /**
     * @var string
     */
    protected $appRoot;

    /**
     * DrupalConsole constructor.
     * @param $root
     * @param $appRoot
     */
    public function __construct($root, $appRoot = null)
    {
        $this->root = $root;
        $this->appRoot = $appRoot;
    }

    /**
     * @return ContainerBuilder
     */
    public function boot()
    {
        $container = new ContainerBuilder();
        $loader = new YamlFileLoader($container, new FileLocator($this->root));
        $loader->load($this->root.DRUPAL_CONSOLE_CORE.'/services.yml');
        if (file_exists($this->root.'/services.yml')) {
            $loader->load('services.yml');
        }

        if (file_exists($this->root.DRUPAL_CONSOLE.'/services-drupal-install.yml')) {
            $loader->load(
                $this->root . DRUPAL_CONSOLE . '/services-drupal-install.yml'
            );
        }

        $container->get('console.configuration_manager')
            ->loadConfiguration($this->root)
            ->getConfiguration();

        $container->get('console.translator_manager')
            ->loadCoreLanguage('en', $this->root);

        $appRoot = $this->appRoot?$this->appRoot:$this->root;
        $container->set(
            'app.root',
            $appRoot
        );
        $consoleRoot = $appRoot;
        if (stripos($this->root, '/bin/') <= 0) {
            $consoleRoot = $this->root;
        }
        $container->set(
            'console.root',
            $consoleRoot
        );

        $configurationManager = $container->get('console.configuration_manager');
        $directory = $configurationManager->getConsoleDirectory() . 'extend/';
        $autoloadFile = $directory . 'vendor/autoload.php';
        if (is_file($autoloadFile)) {
            include_once $autoloadFile;
            $extendServicesFile = $directory . 'extend.console.services.yml';
            if (is_file($extendServicesFile)) {
                $loader->load($extendServicesFile);
            }
        }

        $container->get('console.renderer')
            ->setSkeletonDirs(
                [
                    $this->root.'/templates/',
                    $this->root.DRUPAL_CONSOLE_CORE.'/templates/'
                ]
            );

        return $container;
    }
}
