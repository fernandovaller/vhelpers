<?php

namespace FVCode\VHelpers;

class Helper
{
    /**
     * Formata um valor conforme o padrão de mascara informado
     * Exemplo de mascaras:
     * [CPF => ###.###.###-##]
     * [CNPJ => ##.###.###/####-##]
     *
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
     * Converte uma data no padrão US para o padrão BR
     *
     * @param string $date Data no formato YYYY-MM-DDD
     * @return string Data no formato DD-MM-YYYY
     */
    public static function dateBR($date)
    {
        if (empty($date) || $date == '0000-00-00') {
            return '';
        }

        return date("d/m/Y", strtotime($date));
    }

    /**
     * Converte uma data com hora no padrão US para o padrão BR
     *
     * @param string $date_time Data no formato YYYY-MM-DDD 0:00:00
     * @return string Data no formato DD-MM-YYYY 00:00:00
     */
    public static function dateTimeBR($date_time)
    {
        if (empty($date_time) || $date_time == '0000-00-00 0:00:00') {
            return '';
        }

        return date("d/m/Y G:i:s", strtotime($date_time));
    }

    /**
     * Converte uma data no padrão BR para o padrão US
     *
     * @param string $date Data no formato DD/MM/YYYY
     * @return string Data no formato YYYY-MM-DDD
     */
    public static function dateUS($date)
    {
        if (empty($date) || strlen($date) < 8) {
            return '';
        }

        $date = \DateTime::createFromFormat('d/m/Y', $date, new \DateTimeZone('America/Fortaleza'));
        return $date->format('Y-m-d');
    }

    /**
     * Converte uma data com hora no padrão BR para o padrão US
     *
     * @param string $date_time Data no formato D/M/YYYY 00:00:00
     * @return string Data no formato YYYY-MM-DD 00:00:00
     */
    public static function dateTimeUS($date_time)
    {
        if (empty($date_time) || strlen($date_time) < 16) {
            return '';
        }

        $date = \DateTime::createFromFormat('d/m/Y G:i:s', $date_time, new \DateTimeZone('America/Fortaleza'));
        return $date->format('Y-m-d G:i:s');
    }

    /**
     * Traduz a descrição de Dias e Meses em US para BR
     *
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
     *
     * @param string $date Data no formato YYYY-MM-DD, se não informado pega a data atual
     * @return string Exemplo: quinta-feira, 06 de março de 2014
     */
    public static function dateDescriptionFull($date = 'today')
    {
        return strftime('%A, %d de %B de %Y', strtotime($date));
    }

    /**
     * Força o redirecionamento para uma URL
     *
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

    /**
     * Formata um valor para o padrão brasileiro (R$ - Real)
     * @param float $valor Valor no formato 123.45
     * @param integer $decimal numero de casas decimais
     * @param string $zero retorno vazio ou zero
     */
    public static function moeda($valor, $decimal = 2, $zero = '0')
    {
        if (empty($valor) && $zero != '0') {
            return $zero;
        }

        if (empty($valor) || $valor == 0) {
            $valor = 0;
        }

        return number_format($valor, $decimal, ',', '.');
    }

    /**
     * Formata um valor para o padrão americano ($ - US Dola)
     * @param float $valor Valor no formato 123.45
     * @param integer $decimal numero de casas decimais
     * @param string $zero retorno vazio ou zero
     */
    public static function moedaUS($valor, $decimal = 2, $zero = '0')
    {
        if (empty($valor) && $zero != '0') {
            return $zero;
        }

        if (empty($valor) || $valor == 0) {
            $valor = 0;
        }

        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);

        return number_format($valor, $decimal, '.', '');
    }

    /**
     * Exibir ou Registrar uma mensagem na sessão
     * @param string $msg Mensagem a ser registrada
     * @param string $tipo Tipo de mensagem [success, info, warning, danger]
     * @param boolean $template Informar se a mensagem uso o template do bootstrap
     * @return true|string
     */
    public static function flash($msg = '', $tipo = 'success', $template = true)
    {
        if (!empty($msg)) {
            $_SESSION['flash'][] = $template ? self::alertTemplate($msg, $tipo) : $msg;
            return true;
        }

        if (isset($_SESSION['flash']) && !empty($_SESSION['flash'])) {
            $msg = implode("\n", $_SESSION['flash']);
            unset($_SESSION['flash']);
            return $msg;
        }
    }

    /**
     * Criar um alerta com um template do componente alert do bootstrap
     * @param string $msg Mensagem a ser inserida no template
     * @param string $tipo Tipo de mensagem [success, info, warning, danger]
     * @param string $title Texto em destaque na mensagem
     * @return string
     */
    public static function alertTemplate($msg, $tipo = 'success', $title = '')
    {
        $msg_title = !empty($title) ? "<strong>{$title}</strong>" : '';

        $btn_close = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';

        return '<div class="alert alert-' . $tipo . '">' . $btn_close . $msg_title . $msg . '</div>';
    }
}
