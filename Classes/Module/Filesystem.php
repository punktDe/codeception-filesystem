<?php

namespace PunktDe\Codeception\Filesystem\Module;

/*
 * This file is part of the PunktDe\Codeception-Filesystem package.
 *
 * This package is open source software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use PHPUnit\Framework\Assert;

class Filesystem extends \Codeception\Module\Filesystem
{
    /**
     * @param string $dir
     */
    public function createDirectory(string $dir)
    {
        mkdir($dir);
    }


    /**
     * Returns null if $directoryA and $directoryB are equal.
     * Returns a diff if $directoryA and $directoryB are different.
     * @param string $directoryA
     * @param string $directoryB
     * @param bool $prettifyXML Format XML files in output directory
     * @return null
     */
    public function directoriesMatch(string $directoryA, string $directoryB, $prettifyXML = false)
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
}
