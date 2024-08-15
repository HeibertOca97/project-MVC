<?php

namespace core\interfaces;

interface ICookieRequest{
    public function toCreateTheEntry(string $nameMethod);
    public function toDeleteTheEntry(string $nameMethod);
}
