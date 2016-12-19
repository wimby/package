<?php

namespace Wimby\Skeleton;

use Composer\Command\BaseCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Twig_Environment;
use Twig_Loader_Filesystem;


class GenerateSkeletonCommand extends BaseCommand
{
    protected function configure() {
        $this->setName('generate-skeleton');
        $this->setDescription('Generate basic package files useful for Github package');
        $this->setDefinition([
            new InputArgument('files', InputArgument::OPTIONAL | InputArgument::IS_ARRAY)
        ]);
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln('<warning>Executing</warning>');

        $files = $input->getArgument('files');

        if (count($files) === 0) {
            $files = ['*'];
        }

        foreach ($files as $glob) {
            foreach (glob(__DIR__ . '/files/' . $glob) as $file) {
                $ext = pathinfo($file, PATHINFO_EXTENSION);

                if (strtolower($ext) === 'twig') {
                    $loader = new Twig_Loader_Filesystem($file);
                    $twig = new Twig_Environment($loader);

                    file_put_contents($file, $twig->render($file, ['name' => 'world']));
                } else {
                    copy($file, $file);
                }
            }
        }

        if (!file_exists('src')) {
            mkdir('src', 0777);
        }
    }
}
