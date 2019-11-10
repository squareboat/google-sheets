<?php

namespace Squareboat\Sheets;

use Squareboat\Sheets\Actions\Write;
use Squareboat\Sheets\Actions\Create;
use Squareboat\Sheets\Actions\Delete;

class Sheet
{
    private $service;

    private $identifier;
    
    public function __construct() 
    {
        $this->service = (new Service())->make();
    }

    public function setIdentifier(string $identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Create a new SpreadSheet.
     * 
     * @param string $title
     * 
     * @return self
     */
    public function create(string $title)
    {
        $this->identifier = (new Create($this->service))->handle($title);

        return $this;
    }

    public function write(array $values)
    {
        (new Write($this->service))->handle($this->identifier, $values);

        return $this;
    }

    public function delete()
    {
        (new Delete($this->service))->handle($this->identifier);

        return $this;
    }
}