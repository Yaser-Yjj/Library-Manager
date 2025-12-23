<?php

namespace Config;

use CodeIgniter\Config\CURLRequest as BaseCURLRequest;

class CURLRequest extends BaseCURLRequest
{
    public bool $shareOptions = false;
}
