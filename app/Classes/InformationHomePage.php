<?php

namespace App\Classes;

readonly class InformationHomePage
{
    public function __construct(
        public string $title,
        public string $description,
    ){}
}
