<?php

namespace DOKU\Service;

use DOKU\Common\PaycodeGeneratorVa;

class BcaVa
{

    public static function generated($config, $params)
    {
        $params['targetPath'] = '/bca-virtual-account/v2/payment-code';
        return PaycodeGeneratorVa::post($config, $params);
    }
}
