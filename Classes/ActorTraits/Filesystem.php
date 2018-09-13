<?php

namespace PunktDe\Codeception\Filesystem\ActorTraits;

trait Filesystem
{
    /**
     * @Given I create the output directory :dir if it does not exist
     * @param string $dir
     */
    public function iCreateTheOutputDirectoryIfItDoesNotExist(string $dir)
    {
        $this->createDirectory(codecept_output_dir() . '/' . $dir);
    }

    /**
     * @Given I clean the output directory :dir
     * @param string $dir
     */
    public function iCleanTheOutputDirectory(string $dir)
    {
        $this->cleanDir(codecept_output_dir() . '/' . $dir);
    }

    /**
     * @Given the data directory :directoryA matches the output directory :directoryB
     * @param string $directoryA
     * @param string $directoryB
     */
    public function theDataDirectoryMatchesTheOutputDirectory(string $directoryA, string $directoryB)
    {
        $this->directoriesMatch(codecept_data_dir() . '/' . $directoryA, codecept_output_dir() . '/' . $directoryB, true);
    }

}
