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
}
