<?php
declare(strict_types=1);

namespace Go\Functional;

use PHPUnit_Framework_TestCase as TestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

abstract class BaseFunctionalTest extends TestCase
{
    protected static $projectDir            = __DIR__ . '/../../Fixtures/project';
    protected static $aspectCacheDir        = __DIR__ . '/../../Fixtures/project/var/cache/aspect';
    protected static $consolePath           = __DIR__ . '/../../Fixtures/project/bin/console';
    protected static $frontControllerPath   = __DIR__ . '/../../Fixtures/project/web/index.php';

    protected static function clearCache()
    {
        $filesystem = new Filesystem();

        if ($filesystem->exists(self::$aspectCacheDir)) {
            $filesystem->remove(self::$aspectCacheDir);
        }
    }

    protected static function warmUp()
    {
        return self::exec('cache:warmup:aop');
    }

    protected static function exec($command, $args = '')
    {
        $commandStatement = sprintf('php %s %s %s %s',
            self::$consolePath,
            $command,
            self::$frontControllerPath,
            $args
        );

        $process = new Process($commandStatement);

        $process->run();

        self::assertTrue($process->isSuccessful(), sprintf('Unable to execute "%s" command.', $command));

        return $process->getOutput();
    }
}
