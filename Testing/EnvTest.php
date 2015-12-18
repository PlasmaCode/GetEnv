<?php
namespace PlasmaCode\GetEnv\Testing;

use PlasmaCode\GetEnv\Env;

class EnvTest extends \PHPUnit_Framework_TestCase
{

    public function testWrongExtension()
    {
        $this->setExpectedException('Exception', 'Failed validating file path');
        $filePath = __DIR__ . '/../ENvFiles/test.exe';
        $Env = new Env($filePath);
    }
    
    public function testWrongFile()
    {
        $this->setExpectedException('Exception', 'Failed validating file path');
        $filePath = __DIR__ . '/../EnvFiles/wrongFile.env';
        $Env = new Env($filePath);
    }
    
    public function testSpacesInFilePath()
    {
        $filePath = __DIR__ . '/../EnvFiles/test with spaces.env';
        $Env = new Env($filePath);
    }
    
    public function testSpacesInEnvFile()
    {
        $filePath = __DIR__ . '/../EnvFiles/envWithSpaces.env';
        $Env = new Env($filePath);
    }
    
    //capped extension = .ENV
    public function testWithCappedExtension()
    {
        $filePath = __DIR__ . '/../EnvFiles/test.ENV';
        $Env = new Env($filePath);
    }
    
    public function testWithBadEnvSettings()
    {
        $this->setExpectedException('Exception', 'Failed parsing the .env file, settings are badly formatted');
        $filePath = __DIR__ . '/../EnvFiles/badenv.env';
        $Env = new Env($filePath);
    }

    public function testCorrect()
    {
        $filePath = __DIR__ . '/../EnvFiles/test.env';
        $Env = new Env($filePath);
    }
}
