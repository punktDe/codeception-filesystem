<?php

namespace PunktDe\Codeception\Filesystem\Module;

/*
 * This file is part of the PunktDe\Codeception-Filesystem package.
 *
 * This package is open source software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Exception;
use PHPUnit\Framework\Assert;

class Filesystem extends \Codeception\Module\Filesystem
{
    /**
     * @param string $dir
     */
    public function createDirectory(string $dir): void
    {
        mkdir($dir);
    }


    /**
     * Returns null if $directoryA and $directoryB are equal.
     * Returns a diff if $directoryA and $directoryB are different.
     * @param string $directoryA
     * @param string $directoryB
     * @param bool $prettifyXML Format XML files in output directory
     */
    public function directoriesMatch(string $directoryA, string $directoryB, $prettifyXML = false): void
    {
        if ($prettifyXML) {
            $recursivelyPrettifyXML = function ($dir) {
                foreach (glob($dir . '/' . '*.xml') as $file) {
                    $doc = new \DomDocument();
                    $doc->preserveWhiteSpace = false;
                    $doc->formatOutput = true;
                    $doc->load($file);
                    $doc->save($file);
                }
            };
            $recursivelyPrettifyXML($directoryB);
        }

        $diffFile = '/tmp/' . uniqid('directory_diff_');
        $exitStatus = shell_exec('diff -r ' . escapeshellarg($directoryA) . ' ' . escapeshellarg($directoryB) . ' >' . $diffFile . ' 2>&1; echo -n $?');
        $diff = file_get_contents($diffFile);
        unlink($diffFile);
        Assert::assertEquals('0', $exitStatus, $diff);
    }


    /**
     * @param string $sourceFile
     * @param string $destinationPath
     * @throws Exception
     */
    public function copyFile(string $sourceFile, string $destinationPath)
    {
        if (is_file($sourceFile)) {
            $fileName = basename($sourceFile);
            if (is_dir($destinationPath)) {
                $destinationPath = $destinationPath . '/' . $fileName;
                copy($sourceFile, $destinationPath);
            } else {
                throw new Exception($destinationPath . ' is not a directory!');
            }
        } else {
            throw new Exception($sourceFile . ' is no file!');
        }
    }
}
