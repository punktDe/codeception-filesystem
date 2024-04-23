<?php

namespace PunktDe\Codeception\Filesystem\ActorTraits;

use Codeception\PHPUnit\TestCase;

trait Filesystem
{
    /**
     * @Given I create the output directory :dir if it does not exist
     * @param string $dir
     */
    public function iCreateTheOutputDirectoryIfItDoesNotExist(string $dir): void
    {
        $this->createDirectory(codecept_output_dir() . '/' . $dir);
    }

    /**
     * @Given I clean the output directory :dir
     * @param string $dir
     */
    public function iCleanTheOutputDirectory(string $dir): void
    {
        $this->cleanDir(codecept_output_dir() . '/' . $dir);
    }

    /**
     * @Given the data directory :directoryA matches the output directory :directoryB
     * @param string $directoryA
     * @param string $directoryB
     */
    public function theDataDirectoryMatchesTheOutputDirectory(string $directoryA, string $directoryB): void
    {
        $this->directoriesMatch(codecept_data_dir() . '/' . $directoryA, codecept_output_dir() . '/' . $directoryB, true);
    }

    /**
     * @Then I can see file :file
     * @param string $file
     */
    public function iCanSeeThisFileMatches(string $file): void
    {
        $this->canSeeThisFileMatches($file);
    }

    /**
     * @Then I see file :filename in :path found
     * @param string $filename
     * @param string $path
     */
    public function iSeeFileFound(string $filename, string $path): void
    {
        $this->seeFileFound($filename, $path);
    }

    /**
     * @Given I copy the directory :sourcePath to :destinationPath
     * @param string $sourcePath Source path starting at the current working directory (it's a codeception thing...)
     * @param string $destinationPath Destination path starting at the current working directory (it's a codeception thing...)
     */
    public function iCopyDirectory(string $sourcePath, string $destinationPath)
    {
        $this->copyDir($sourcePath, $destinationPath);
    }

    /**
     * @Given I copy the file :sourceFile to :destinationPath
     * @param string $sourceFile
     * @param string $destinationPath
     */
    public function iCopyFile(string $sourceFile, string $destinationPath)
    {
        $absoluteSourceDir = codecept_data_dir($sourceFile);
        $sourceRealpath = realpath($absoluteSourceDir);
        
        if ($sourceRealpath === false) {
            TestCase::fail('source file ' . $sourceFile . ' does not exist');
        }

        $absoluteDestinationDir = codecept_data_dir($destinationPath);
        $destinationRealpath = realpath($absoluteDestinationDir);
        if ($destinationRealpath === false || !is_dir(destinationRealpath)) {
            TestCase::fail('destination path ' . $destinationPath . ' does not exist or is not a directory');
        }

        $this->copyFile($sourceRealpath, $absoluteDestinationDir);
    }

    /**
     * @Given I delete the directory :directory
     * @param string $directory The directory relative to the codeception data directory
     */
    public function iDeleteDir(string $directory)
    {
        $absoluteDir = codecept_data_dir($directory);
        $realpath = realpath($absoluteDir);

        if ($realpath !== false) {
            codecept_debug('Deleting directory ' . $realpath);
            $this->deleteDir($realpath);
        } else {
            codecept_debug('Not deleting directory ' . $directory . ' because it does not exist');
            codecept_debug('Absolute path: ' . $absoluteDir);
        }
    }

    /**
     * @Given I delete the file :file
     * @param string $file
     */
    public function iDeleteFile(string $file)
    {
        $absolutePath = codecept_data_dir($file);
        $realpath = realpath($absolutePath);

        if ($realpath !== false) {
            codecept_debug('Deleting file ' . $realpath);
            $this->deleteFile($realpath);
        } else {
            codecept_debug('Not deleting file ' . $file . ' because it does not exist');
            codecept_debug('Absolute path: ' . $absolutePath);
        }
    }
}
