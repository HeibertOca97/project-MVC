<?php

namespace libs;

use UAParser\Parser;

class UAParser
{
    private $parser;

    public function __construct()
    {
        $ua = $_SERVER["HTTP_USER_AGENT"];
        $parser = Parser::create();
        $this->parser = $parser->parse($ua);
    }

    public function browserFamily()
    {
        return $this->parser->ua->family;
    }

    public function browser()
    {
        return $this->parser->ua->toString();
    }

    public function osFamily()
    {
        return $this->parser->os->family;
    }

    public function os()
    {
        return $this->parser->os->toString();
    }

    public function infoComplete()
    {
        return $this->parser->toString();
    }

    public function deviceFamily()
    {
        return $this->parser->device->family;
    }
}
