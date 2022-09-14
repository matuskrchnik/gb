<?php

namespace Interface\Parser;

interface Parser
{
    public function openFile(string $fileName): void;
    public function getData(): array;
}