<?php

require('src/Controller/CsvParser.php');
require('src/Controller/SentimentAnalyzer.php');

use Controller\CsvParser\CsvParser;
use Controller\SentimentAnalyzer\SentimentAnalyzer;

$csv = CsvParser::getInstance("db.csv", false);

$sentimentAnalyzer = SentimentAnalyzer::getInstance($csv->getData());
$mostPositive = $sentimentAnalyzer->getDataBy('pos', 'desc')[0];
$mostNegative = $sentimentAnalyzer->getDataBy('pos', 'asc')[0];

echo nl2br("Most positive product description is:\n {$mostPositive['title']} - {$mostPositive['text']} with {$mostPositive['pos']} score\n\n");
echo nl2br("Most negative description is:\n {$mostNegative['title']} - {$mostNegative['text']} with {$mostNegative['pos']} score");
