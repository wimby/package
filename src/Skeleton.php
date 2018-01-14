<?php
namespace Wimby\Skeleton;

use Composer\Script\Event;

class Skeleton
{
    public static function postCreateProjectCmd(Event $event)
    {
        static::copySkeletonFiles($event);
        static::registerGitHooks($event);
    }

    public static function preCommit(Event $event)
    {
        static::validateSkeleton($event);
        static::validateComposer($event);
        static::phpLint($event);
        static::codeStyle($event);
    }

    public static function copySkeletonFiles(Event $event)
    {
        $composer = $event->getComposer();
        $resources = $composer->getConfig()->get('vendor-dir') . '/wimby/skeleton/resources/';

        foreach (glob(__DIR__ . '/resources/*') as $file) {
            // $ext = pathinfo($file, PATHINFO_EXTENSION);
            copy($file, $file);
        }

        // $io->write('<info>Ensuring src directory</info>');
        if (!is_dir('src')) {
            mkdir('src', 0644);
        }
    }

    public static function registerGitHooks(Event $event)
    {
        $composer = $event->getComposer();
        $vendorDir = $composer->getConfig()->get('vendor-dir');

        $io = $event->getIO();
        $io->write('<info>Checking pre-commit git hook</info>');
        $io->write('Git pre-commit hook is already registered');
        if ($io->askConfirmation('Do you want to register git hooks? [Y/n]')) {
            $io->write('<info>Registering git pre-commit hook</info>');
        }
        $io->write('<info>Git pre-commit hook successfully registered</info>');
        // symlink instead of copy?
        $io->write(
            '<error>
Error while copying ./resources/pre-commit to .git/hooks/pre-commit, please copy it yourself</error>'
        );
    }

    public static function validateSkeleton(Event $event)
    {
        static::execScript($event, 'pds-skeleton', ['validate']);
    }

    public static function validateComposer(Event $event)
    {
        static::execScript($event, 'composer', ['validate']);
    }

    public static function phpLint(Event $event)
    {
        static::execScript($event, 'phplint');
    }

    public static function codeStyle(Event $event)
    {
        static::execScript($event, 'phpcs', ['src', '--standard=PSR2']);
    }

    protected static function execScript(Event $event, $script, $arguments = [])
    {
        $composer = $event->getComposer();
        $dispatcher = $composer->getEventDispatcher();
        $dispatcher->addListener("__exec_script_$script", $script);
        $dispatcher->dispatchScript("__exec_script_$script", $event->isDevMode(), $arguments);
    }
}
