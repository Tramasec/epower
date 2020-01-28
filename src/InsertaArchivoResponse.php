<?php
declare(strict_types=1);

namespace EPower;

class InsertaArchivoResponse
{
    public $uploaded = false;
    public $responseTime = 0;
    public $error = '';

    public function __construct(bool $uploaded, float $responseTime, string $error = '')
    {
        $this->uploaded = $uploaded;
        $this->responseTime = $responseTime;
        $this->error = $error;
    }
}
