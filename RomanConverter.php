<?php

class RomanConverter {
    private $values = [
        1000 => 'M', 900 => 'CM', 500 => 'D', 400 => 'CD',
        100 => 'C', 90 => 'XC', 50 => 'L', 40 => 'XL',
        10 => 'X', 9 => 'IX', 5 => 'V', 4 => 'IV', 1 => 'I'
    ];
    
    private $numerals = [
        'I' => 1, 'V' => 5, 'X' => 10, 'L' => 50, 
        'C' => 100, 'D' => 500, 'M' => 1000
    ];
    
    public function arabicToRoman(int $num): string {
        if ($num <= 0 || $num > 3999) {
            throw new InvalidArgumentException('O número precisa estar entre 0 e 3999');
        }
        
        $roman_num = '';
        foreach ($this->values as $value => $symbol) {
            while ($num >= $value) {
                $roman_num .= $symbol;
                $num -= $value;
            }
        }
        return $roman_num;
    }
    
    public function romanToArabic(string $roman): int {
        $total = 0;
        $prev_value = 0;
        $length = strlen($roman);

        for ($i = $length - 1; $i >= 0; $i--) {
            $char = $roman[$i];
            if (!isset($this->numerals[$char])) {
                throw new InvalidArgumentException('Número romano inválido');
            }
            $value = $this->numerals[$char];
            
            if ($value < $prev_value) {
                $total -= $value;
            } else {
                $total += $value;
            }
            $prev_value = $value;
        }
        return $total;
    }
}

