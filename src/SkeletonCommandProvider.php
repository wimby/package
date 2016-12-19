<?php

namespace Wimby\Skeleton;

use Composer\Plugin\Capability\CommandProvider;


class SkeletonCommandProvider implements CommandProvider {

    public function getCommands() {
        return [
            new GenerateSkeletonCommand(),
        ];
    }
}
