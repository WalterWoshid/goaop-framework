<?php
/**
 * Go! AOP framework
 *
 * @copyright Copyright 2013-2022, Lisachenko Alexander <lisachenko.it@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Go\Console\Command;

use Go\Core\AspectKernel;
use InvalidArgumentException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Base command for all aspect commands
 *
 * @codeCoverageIgnore
 */
class BaseAspectCommand extends Command
{
    /**
     * Stores an instance of aspect kernel
     */
    protected ?AspectKernel $aspectKernel = null;

    /**
     * {@inheritDoc}
     */
    protected function configure(): void
    {
        $this->addArgument('loader', InputArgument::REQUIRED, 'Path to the aspect loader file');
    }

    /**
     * Loads aspect kernel.
     *
     * Aspect kernel is loaded by executing loader and fetching singleton instance.
     * If your application environment initializes aspect kernel differently, you may
     * modify this method to get aspect kernel suitable to your needs.
     */
    protected function loadAspectKernel(InputInterface $input, OutputInterface $output): void
    {
        $loader = $input->getArgument('loader');
        $path   = stream_resolve_include_path($loader);
        if (!is_readable($path)) {
            throw new InvalidArgumentException("Invalid loader path: {$loader}");
        }

        ob_start();
        include_once $path;
        ob_clean();

        if (!class_exists(AspectKernel::class, false)) {
            $message = "Kernel was not initialized yet, please configure it in the {$path}";
            throw new InvalidArgumentException($message);
        }

        $this->aspectKernel = AspectKernel::getInstance();
    }
}
