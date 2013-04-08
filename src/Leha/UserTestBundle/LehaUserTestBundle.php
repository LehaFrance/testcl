<?php

namespace Leha\UserTestBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LehaUserTestBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
