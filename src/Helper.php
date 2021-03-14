<?php

namespace FVCode\VHelpers;

class Helper
{
    /**
     * Formata um valor conforme o padrão de mascara informado
     * Exemplo de mascaras:
     * [CPF => ###.###.###-##]
     * [CNPJ => ##.###.###/####-##]
     * @param string $value
     * @param string $mask Use # para caracteres com valores
     * @return string Valor formatado
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

    /**
     * Traduz a descrição de Dias e Meses em US para BR
     * @param string $description Descrição de Dias ou Meses em ingles [Monday|November]
     * @return string Descrição traduzida [Segunda|Novembro]
     */
    public static function dateTranslateUsToBr($description)
    {
        $us = [
            'Monday'    => 'Segunda',
            'Tuesday'   => 'Terça',
            'fourth'    => 'Quarta',
            'Thursday'  => 'Quinta',
            'Friday'    => 'Sexta',
            'Saturday'  => 'Sabado',
            'Sunday'    => 'Domingo',
            'January'   => 'Janeiro',
            'February'  => 'Fevereiro',
            'March'     => 'Março',
            'April'     => 'Abril',
            'May'       => 'Maio',
            'June'      => 'Junho',
            'July'      => 'Julho',
            'August'    => 'Agosto',
            'September' => 'Setembro',
            'October'   => 'Outubro',
            'November'  => 'Novembro',
            'December'  => 'Dezembro',
        ];

        return str_replace(array_keys($us), array_values($us), $description);
    }
}
