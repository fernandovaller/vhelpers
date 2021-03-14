<?php

namespace FVCode\VHelpers;

class Helper
{
    /**
     * Formata um valor conforme o padrão de mascara informado
     * @param string $value
     * @param string $mask
     */
    public static function mask($value, $mask)
    {
        $maskared = [];

        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {

            if ($mask[$i] == '#') {
                if (isset($value[$k])) {
                    $maskared[] = $value[$k++];
                    continue;
                }
            }

            if (isset($mask[$i])) {
                $maskared[] = $mask[$i];
            }
        }

        return implode('', $maskared);
    }
}
