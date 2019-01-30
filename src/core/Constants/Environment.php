<?php

namespace Endocore\Core\Constants;

use MabeEnum\Enum;

abstract class Environment extends Enum
{
    const DEV = 0;
    const TEST=1;
    const PROD = 2;

}
