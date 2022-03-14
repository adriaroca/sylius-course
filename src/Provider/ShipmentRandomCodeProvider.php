<?php

namespace App\Provider;

class ShipmentRandomCodeProvider implements ShipmentRandomCodeProviderInterface
{
    public function provide(): string
    {
        return bin2hex(random_bytes(5));
    }
}
