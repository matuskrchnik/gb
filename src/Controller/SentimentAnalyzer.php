<?php

namespace Controller\SentimentAnalyzer;

require('vendor/autoload.php');
require('src/Controller/Utils.php');

Use Sentiment\Analyzer;
use Controller\Utils\Utils;

class SentimentAnalyzer
{
    public Analyzer $analyzer;
    private array $data;
    public array $sentimentData;

    private static ?SentimentAnalyzer $instance = null;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->analyzer = new Analyzer();
    }

    public static function getInstance(array $data): self
    {
        if (self::$instance == null)
            self::$instance = new SentimentAnalyzer($data);

        return self::$instance;
    }

    public function appendSentiment(): array{
        $this->sentimentData = array();
        foreach ($this->data as $key => $value){
            $this->sentimentData[] = array_merge(array('title' => $this->data[$key][0], 'text' => $this->data[$key][1]), $this->analyzer->getSentiment($this->data[$key][1]));
        }
        return $this->sentimentData;
    }

    public function getDataBy($sortBy, $orderBy)
    {
        return self::multiSort($sortBy, $this->appendSentiment(), $orderBy);
    }

    public static function multiSort(string $sortBy, array $data, string $orderBy = SORT_ASC): array
    {
        $orderBy = ($orderBy == 'desc' ? SORT_DESC : SORT_ASC);
        array_multisort(Utils::sortBy($sortBy, $data), $orderBy, $data);
        return $data;
    }
}