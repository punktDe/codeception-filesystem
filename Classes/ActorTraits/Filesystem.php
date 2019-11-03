<?php

namespace PunktDe\Codeception\Filesystem\ActorTraits;

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
        $this->SeeFileFound($filename, $path);
    }

}
