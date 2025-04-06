<?php
/**
 * micro framework v1.0 
 * @author Adal Khan <A01799729507@gmail.com>
 * 01. Test Maintanance Mode
 * 02. Register the autoloader
 * 03. Create an instance of the application (R)
 * 04. Activate request handling
 * */

require_once __DIR__.'/../vendor/autoload.php';

class Boot {
    public function boot(): array {
        return ["arr"=>"name"]
    }
}



