<?php
class GetEnv{
    protected $file;
    public function __construct()
    {
        //var_dump(__DIR__."/.env");
        $this->file = fopen(__DIR__."/.env", "r")or die("Unable to open file!");
        while(!feof($this->file)) {
           $row = explode("=",fgets($this->file));
           $_ENV[$row[0]]=trim($row[1]);
          }
          fclose($this->file);
    }
}