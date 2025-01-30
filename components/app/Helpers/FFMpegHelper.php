<?php

namespace App\Helpers;

class FFMpegHelper
{
    public static function executeFFMpeg($command)
    {
        $descriptorspec = [
            0 => ["pipe", "r"], // STDIN
            1 => ["pipe", "w"], // STDOUT
            2 => ["pipe", "w"], // STDERR
        ];

        $process = proc_open($command, $descriptorspec, $pipes, null, null);

        if (is_resource($process)) {
            $output = stream_get_contents($pipes[1]);
            $errorOutput = stream_get_contents($pipes[2]);

            fclose($pipes[1]);
            fclose($pipes[2]);

            $returnCode = proc_close($process);

            if ($returnCode === 0) {
                return $output;
            } else {
                return "Error executing FFMpeg: " . $errorOutput;
            }
        }

        return "Failed to execute FFMpeg process.";
    }
}
