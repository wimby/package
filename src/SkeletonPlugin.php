<?php

namespace Wimby\Skeleton;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\Capable;
use Composer\Plugin\PluginInterface;


class SkeletonPlugin implements PluginInterface, Capable
{
    /**
     * @var Composer
     */
    protected $composer;

    /**
     * @var IOInterface
     */
    protected $io;

    public function activate(Composer $composer, IOInterface $io) {
        $this->composer = $composer;
        $this->io = $io;
    }

    public function getCapabilities() {
        return [
            'Composer\Plugin\Capability\CommandProvider' => 'Wimby\Skeleton\SkeletonCommandProvider',
        ];
    }
}
