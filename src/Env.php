<?php
namespace PlasmaCode\GetEnv;
use Exception;

class Env
{
    public $envArray;
    
    public function __construct($filePath)
    {
        if($this->validateFilePath($filePath) === false) {
            throw new Exception('Failed validating file path');
        }
        
        $envContent = $this->getEnvContent($filePath);
        
        if($envContent === false) {
            throw new Exception('Failed parsing the .env file, settings are badly formatted');
        }
        
        $this->setEnvVars($envContent);
    }
    
    private function setEnvVars(array $envContent)
    {
        $this->envArray = $envContent;
        foreach ($envContent as $envValue) {
            
            //format the matches
            $noSpace = $envValue = str_replace(' = ', '=', $envValue);
            $envValue = str_replace('"', '', $envValue);
            $envValue = str_replace("'", "", $envValue);
            $envValue = explode('=', $envValue);
            
            $setting = $envValue[0];
            $value = $envValue[1];

            //set enviromental variables
            putenv($noSpace);
            $_ENV[$setting] = $value;
            $_SERVER[$setting] = $value;
            
        }
    }
    
    //checks to make sure the file path is legit
    private function validateFilePath($filePath)
    {
 
        //last 4 characters to get extension of file path
        $filePathExt = substr($filePath, -4);
        if(!is_readable($filePath) || !file_exists($filePath) || ($filePathExt != '.env' && $filePathExt != '.ENV')) {
            return false;
        }
        
        return true;
    }
    
    private function getEnvContent($filePath)
    {    
        $fileContents = file_get_contents($filePath);
        
        //get all env configurations from file contents
        $regex = '/(\w+\s*=\s*[\'"]\w+[\'"])/';
        if(preg_match_all($regex, $fileContents, $matches) === false) {
            return false;
        }
        
        if($matches[1] == null) {
            return false;
        }
        
        return $matches[1];
    }
}
