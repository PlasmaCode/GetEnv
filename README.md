# GetEnv
Simple .env file setter/getter.


Set your settings in a .env file.

Create new instance of PlasmaCode\GetEnv\Env , and pass the file path as a parameter.



    use PlasmaCode\GetEnv\Env;
    $env = new Env($filepath);

You may now access the declared env setting like so:


    getenv('SETTING');
    $_ENV['SETTING'];
    $_SERVER['SETTING'];
    $env->__get('SETTING');
