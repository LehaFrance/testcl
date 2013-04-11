<?php

namespace Leha\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LehaUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
