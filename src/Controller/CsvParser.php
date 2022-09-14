<?php

namespace Controller\CsvParser;

require('src/Interface/Parser.php');

use Interface\Parser\Parser;

class CsvParser implements Parser
{
    private string $fileName;
    public $handle;
    private $csvData;
    private $withHeader;

    private static ?CsvParser $instance = null;

    public function __construct(string $fileName, bool $withHeader = true)
    {
        $this->fileName = $fileName;
        $this->withHeader = $withHeader;

        $this->openFile($this->fileName);
    }

    public static function getInstance(string $fileName, bool $withHeader = true): self
    {
        if (self::$instance == null)
            self::$instance = new CsvParser($fileName, $withHeader);

        return self::$instance;
    }

    public function openFile(string $fileName): void
    {
        $this->handle = fopen($this->fileName, "r");
    }

    public function getData(): array
    {
        if($this->handle !== FALSE){
            while (($data = fgetcsv($this->handle, 1000, ",")) !== FALSE) {
                $csv[] = $data;
            }
            fclose($this->handle);
        }

        if($this->withHeader === false)
            array_shift($csv);

        return $this->csvData = $csv;
    }
}