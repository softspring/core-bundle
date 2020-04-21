<?php

namespace Softspring\CoreBundle\Utils;

use App\Kernel;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StreamedCommandRunner
{
    /**
     * @param array $command
     */
    public static function runCommand(array $command)
    {
        $response = new StreamedResponse(function() use ($command) {
            self::_doRunCommand(new ArrayInput($command));
        }, 200, [
            'Content-Type' => 'text/plain',
            'X-Accel-Buffering' => 'no',
        ]);

        $response->send();
    }

    /**
     * @param array[] $commands
     */
    public static function runCommands(array $commands)
    {
        $response = new StreamedResponse(function() use ($commands) {
            foreach ($commands as $command) {
                self::_doRunCommand(new ArrayInput($command));
            }
        }, 200, [
            'Content-Type' => 'text/plain',
            'X-Accel-Buffering' => 'no',
        ]);

        $response->send();
    }

    private static function _doRunCommand(InputInterface $input)
    {
        $input->setInteractive(false);

        $env = $input->getParameterOption(['--env', '-e'], $_SERVER['APP_ENV'] ?? 'dev', true);
        $debug = (bool) ($_SERVER['APP_DEBUG'] ?? ('prod' !== $env)) && !$input->hasParameterOption('--no-debug', true);

        if ($debug) {
            umask(0000);

            if (class_exists(Debug::class)) {
                Debug::enable();
            }
        }

        $output = new StreamedCommandOutput(fopen('php://stdout', 'w'));

        $kernel = new Kernel($env, $debug);
        $application = new Application($kernel);
        $application->run($input, $output);
    }
}