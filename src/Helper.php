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

    /**
     * Retorna a data informado por extenso.
     * @param string $date Data no formato YYYY-MM-DD, se não informado pega a data atual
     * @return string Exemplo: quinta-feira, 06 de março de 2014
     */
    public static function dateDescriptionFull($date = 'today')
    {
        return strftime('%A, %d de %B de %Y', strtotime($date));
    }

    /**
     * Força o redirecionamento para uma URL e
     * para o fluxo do programa
     * @param string $url URL a ser redirecionada
     */
    public static function redirect($url)
    {
        if (!headers_sent()) {
            header('Location: ' . $url);
            return true;
        }

        echo '<script type="text/javascript">';
        echo 'window.location.href="' . $url . '";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
        echo '</noscript>';
        return true;
    }
}
