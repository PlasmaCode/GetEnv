<?php
namespace PlasmaCode\GetEnv;

class Env
{
    private $filePath;
    private $fileContents;
    private $error;
    
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
        
        if($this->fileContents() !== true) {
            trigger_error($this->error('fileContents'), E_USER_ERROR);
        }
        
        if($this->setAllEnv() !== true) {
            trigger_error($this->error('setAllEnv'), E_USER_ERROR);
        }
        
        return true;
    }
    
    private function setAllEnv()
    {
        $regex = '/(\w+\s=\s[\'"]\w+[\'"])/';
        
        preg_match_all($regex, $this->fileContents, $matches);
        
        foreach ($matches[1] as $match) {
            
            //format the matches
            $matchNoSpace = $match = str_replace(' = ', '=', $match);
            $match = str_replace('"', '', $match);
            $match = str_replace("'", "", $match);
            $match = explode('=', $match);

            //set enviromental variables
            putenv($matchNoSpace);
            $_ENV[$match[0]] = $match[1];
            $_SERVER[$match[0]] = $match[1];
            
        }
    }
    
    private function fileContents()
    {
        if(!is_readable($this->filePath) && strtolower(substr($this->filePath, -4)) != '.env') {
            return false;
        }
        
        $fileContents = file_get_contents($this->filePath);
        $this->fileContents = $fileContents;
        return true;
    }
    
    private function error($methodName)
    {
        switch($methodName) {
            case 'fileContents':
                return 'The file path '.$this->filePath.' is not a correct .env file path.';
            case 'setAllEnv':
                return 'Incorrect env syntax at file path '.$this->filePath;
        }
    }
}
