# Helpers

Conjunto de helpers que auxiliam nas funcionalidades dos sistemas

### Mask

```php
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
```
