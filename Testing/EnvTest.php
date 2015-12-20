<?php
namespace PlasmaCode\GetEnv\Testing;

use PlasmaCode\GetEnv\Env;

class EnvTest extends \PHPUnit_Framework_TestCase
{

    public function testWrongExtension()
    {
        $expected = 0;
        $this->setExpectedException('Exception', 'Failed validating file path');
        $filePath = __DIR__ . '/../ENvFiles/test.exe';
        $Env = new Env($filePath);
        
        $this->assertEquals($expected, count($Env->envArray));
    }
    
    public function testWrongFile()
    {
        $expected = 0;
        $this->setExpectedException('Exception', 'Failed validating file path');
        $filePath = __DIR__ . '/../EnvFiles/wrongFile.env';
        $Env = new Env($filePath);
        
        $this->assertEquals($expected, count($Env->envArray));
    }
    
    public function testSpacesInFilePath()
    {
        
        $expected = 2;
        $filePath = __DIR__ . '/../EnvFiles/test with spaces.env';
        $Env = new Env($filePath);
        
        $this->assertEquals($expected, count($Env->envArray));
    }
    
    public function testSpacesInEnvFile()
    {
        $expected = 1;
        $filePath = __DIR__ . '/../EnvFiles/envWithSpaces.env';
        $Env = new Env($filePath);
        
        $this->assertEquals($expected, count($Env->envArray));
    }
    
    //capped extension = .ENV
    public function testWithCappedExtension()
    {
        $expected = 5;
        $filePath = __DIR__ . '/../EnvFiles/test.ENV';
        $Env = new Env($filePath);
        
        $this->assertEquals($expected, count($Env->envArray));
    }
    
    public function testWithBadEnvSettings()
    {
        $expected = 0;
        $this->setExpectedException('Exception', 'Failed parsing the .env file, settings are badly formatted');
        $filePath = __DIR__ . '/../EnvFiles/badenv.env';
        $Env = new Env($filePath);
        
        $this->assertEquals($expected, count($Env->envArray));
    }

    public function testCorrect()
    {
        $expected = 5;
        $filePath = __DIR__ . '/../EnvFiles/test.env';
        $Env = new Env($filePath);
        
        $this->assertEquals($expected, count($Env->envArray));
    }
}
