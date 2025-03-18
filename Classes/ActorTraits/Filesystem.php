<?php

namespace PunktDe\Codeception\Filesystem\ActorTraits;

use Codeception\PHPUnit\TestCase;

trait Filesystem
{
    /**
     * @Given I create the directory :dir within data if it does not exist
     * @param string $dir
     */
    public function iCreateTheDirectoryWithinDataIfItDoesNotExist(string $dir): void
    {
        $this->createDirectoryIfItDoesNotExist(codecept_data_dir($dir));
    }


    /**
     * @Given I create the directory :dir within output if it does not exist
     * @param string $dir
     */
    public function iCreateTheDirectoryWithinOutputIfItDoesNotExist(string $dir): void
    {
        $this->createDirectoryIfItDoesNotExist(codecept_output_dir($dir));
    }


    /**
     * @Given I clean the directory :dir within output
     * @param string $dir
     */
    public function iCleanTheOutputDirectory(string $dir): void
    {
        $this->cleanDir(codecept_output_dir($dir));
    }


    /**
     * @Given I clean the directory :dir within data
     * @param string $dir
     */
    public function iCleanTheDataDirectory(string $dir): void
    {
        $this->cleanDir(codecept_data_dir($dir));
    }


    /**
     * @Given the data directory :directoryA matches the output directory :directoryB
     * @param string $directoryA
     * @param string $directoryB
     */
    public function theDataDirectoryMatchesTheOutputDirectory(string $directoryA, string $directoryB): void
    {
        $this->directoriesMatch(
            codecept_data_dir() . '/' . $directoryA,
            codecept_output_dir() . '/' . $directoryB,
            true
        );
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
     * @Then I see file :filename in :path found within data
     * @param string $filename
     * @param string $path
     */
    public function iSeeFileFoundWithinData(string $filename, string $path): void
    {
        $this->seeFileFound($filename, codecept_data_dir($path));
    }


    /**
     * @Then I see file :filename in :path found within output
     * @param string $filename
     * @param string $path
     */
    public function iSeeFileFoundWithinOutput(string $filename, string $path): void
    {
        $this->seeFileFound($filename, codecept_output_dir($path));
    }


    /**
     * @Given I copy the directory :sourcePath to :destinationPath within data
     * @param string $sourcePath
     * @param string $destinationPath
     */
    public function iCopyDirectoryWithinData(string $sourcePath, string $destinationPath)
    {
        $absSourcePath = codecept_data_dir($sourcePath);
        $absDestinationPath = codecept_data_dir($destinationPath);

        codecept_debug('Absolute source path: ' . $absSourcePath);
        codecept_debug('Absolute destination path: ' . $absDestinationPath);
        codecept_debug('Working directory: ' . getcwd());

        $this->copyDir($absSourcePath, $absDestinationPath);
    }


    /**
     * @Given I copy the directory :sourcePath to :destinationPath within output
     * @param string $sourcePath
     * @param string $destinationPath
     */
    public function iCopyDirectoryWithinOutput(string $sourcePath, string $destinationPath)
    {
        $absSourcePath = codecept_output_dir($sourcePath);
        $absDestinationPath = codecept_output_dir($destinationPath);

        codecept_debug('Absolute source path: ' . $absSourcePath);
        codecept_debug('Absolute destination path: ' . $absDestinationPath);
        codecept_debug('Working directory: ' . getcwd());

        $this->copyDir($absSourcePath, $absDestinationPath);
    }


    /**
     * @Given I copy the file :sourceFile to :destinationPath within data
     * @param string $sourceFile
     * @param string $destinationPath
     */
    public function iCopyFileWithinData(string $sourceFile, string $destinationPath)
    {
        $absoluteSourceFile = codecept_data_dir($sourceFile);

        if (file_exists($absoluteSourceFile) === false) {
            TestCase::fail('source file ' . $sourceFile . ' does not exist');
        }

        $absoluteDestinationDir = codecept_data_dir($destinationPath);
        if (file_exists($absoluteDestinationDir) === false || !is_dir($absoluteDestinationDir)) {
            TestCase::fail('destination path ' . $destinationPath . ' does not exist or is not a directory');
        }

        $this->copyFile($absoluteSourceFile, $absoluteDestinationDir);
    }


    /**
     * @Given I copy the file :sourceFile to :destinationPath within output
     * @param string $sourceFile
     * @param string $destinationPath
     */
    public function iCopyFileWithinOutput(string $sourceFile, string $destinationPath)
    {
        $absoluteSourceFile = codecept_output_dir($sourceFile);

        if (file_exists($absoluteSourceFile) === false) {
            TestCase::fail('source file ' . $sourceFile . ' does not exist');
        }

        $absoluteDestinationDir = codecept_output_dir($destinationPath);
        if (file_exists($absoluteDestinationDir) === false || !is_dir($absoluteDestinationDir)) {
            TestCase::fail('destination path ' . $destinationPath . ' does not exist or is not a directory');
        }

        $this->copyFile($absoluteSourceFile, $absoluteDestinationDir);
    }


    /**
     * @Given I delete the directory :dir within data if it exists
     * @param string $directory The directory relative to the codeception data directory
     */
    public function iDeleteDirWithinDataIfItExists(string $directory)
    {
        $absoluteDir = codecept_data_dir($directory);

        if (file_exists($absoluteDir)) {
            codecept_debug('Deleting directory ' . $absoluteDir);
            $this->deleteDir($absoluteDir);
        } else {
            codecept_debug(
                sprintf('Not deleting directory %s with %s because it does not exist', $directory, $absoluteDir)
            );
        }
    }


    /**
     * @Given I delete the directory :dir within output if it exists
     * @param string $directory The directory relative to the codeception data directory
     */
    public function iDeleteDirWithinOutputIfItExists(string $directory)
    {
        $absoluteDir = codecept_output_dir($directory);

        if (file_exists($absoluteDir)) {
            codecept_debug('Deleting directory ' . $absoluteDir);
            $this->deleteDir($absoluteDir);
        } else {
            codecept_debug(
                sprintf('Not deleting directory %s with %s because it does not exist', $directory, $absoluteDir)
            );
        }
    }


    /**
     * @Given I delete the file :file within data
     * @param string $file
     */
    public function iDeleteFileWithinData(string $file)
    {
        $absolutePath = codecept_data_dir($file);

        if (file_exists($absolutePath) !== false) {
            codecept_debug('Deleting file ' . $absolutePath);
            $this->deleteFile($absolutePath);
        } else {
            codecept_debug(
                sprintf('Not deleting file %s with %s because it does not exist', $file, $absolutePath)
            );
        }
    }


    /**
     * @Given I delete the file :file within output
     * @param string $file
     */
    public function iDeleteFileWithinOutput(string $file)
    {
        $absolutePath = codecept_output_dir($file);

        if (file_exists($absolutePath) !== false) {
            codecept_debug('Deleting file ' . $absolutePath);
            $this->deleteFile($absolutePath);
        } else {
            codecept_debug(
                sprintf('Not deleting file %s with %s because it does not exist', $file, $absolutePath)
            );
        }
    }
}
