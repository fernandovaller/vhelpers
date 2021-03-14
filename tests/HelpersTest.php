<?php

use FVCode\VHelpers\Helper;
use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    public function testCpfComMascara()
    {
        $cpf = '92454026066';
        $cpf_whith_mask = '924.540.260-66';

        $cpf_formated = Helper::mask($cpf, '###.###.###-##');

        $this->assertEquals($cpf_whith_mask, $cpf_formated);
    }

    public function testCnpjComMascara()
    {
        $cnpj = '93374518000176';
        $cnpj_whith_mask = '93.374.518/0001-76';

        $cnpj_formated = Helper::mask($cnpj, '##.###.###/####-##');

        $this->assertEquals($cnpj_whith_mask, $cnpj_formated);
    }

    public function testDateTranslate()
    {
        $description_us = 'Monday, 14 March 2021';

        $description_br = 'Segunda, 14 Março 2021';

        $translated = Helper::dateTranslateUsToBr($description_us);

        $this->assertEquals($description_br, $translated);
    }

    /**
     * @test
     * @runInSeparateProcess
     **/
    public function testRedirection()
    {
        $url = 'www.google.com';

        Helper::redirect($url);

        $this->assertContains(
            "Location: {$url}",
            xdebug_get_headers()
        );
    }

    public function testDateDescriptionFull()
    {
        $date = '2014-03-06';
        $date_full = 'Thursday, 06 de March de 2014';

        $description = Helper::dateDescriptionFull($date);

        $this->assertEquals($date_full, $description);
    }

    public function testDateBr()
    {
        $date = '2021-03-14';
        $date_br = '14/03/2021';

        $date_in_br = Helper::dateBR($date);

        $this->assertEquals($date_br, $date_in_br);
    }

    public function testDateTimeBr()
    {
        $date_time = '2021-03-14 14:47:21';

        $date_time_br = '14/03/2021 14:47:21';

        $date_time_in_br = Helper::dateTimeBR($date_time);

        $this->assertEquals($date_time_br, $date_time_in_br);
    }

    public function testDateUs()
    {
        $date = '1/3/2021';
        $date_us = '2021-03-01';

        $date_in_us = Helper::dateUS($date);

        $this->assertEquals($date_us, $date_in_us);
    }

    public function testDateTimeUs()
    {
        $date_time = '4/3/2021 4:47:21';

        $date_time_us = '2021-03-04 4:47:21';

        $date_time_in_us = Helper::dateTimeUS($date_time);

        $this->assertEquals($date_time_us, $date_time_in_us);
    }

    public function testFormatarValorParaReal()
    {
        $valor = 1234.56;
        $valor_br = '1.234,56';

        $valor_in_br = Helper::moeda($valor);

        $this->assertEquals($valor_br, $valor_in_br);
    }

    public function testFormatarValorParaDola()
    {
        $valor = '1.234,56';
        $valor_us = 1234.56;

        $valor_in_us = Helper::moedaUS($valor);

        $this->assertEquals($valor_us, $valor_in_us);
    }
}
