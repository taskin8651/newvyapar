<?php

namespace App\Helpers;

class NumberHelper
{
    /**
     * Convert number to Indian currency words
     * Example: 15250.75 => "Fifteen Thousand Two Hundred And Fifty Rupees And Seventy Five Paise Only"
     */
    public static function toWords($number)
    {
        // Validate number
        if (!is_numeric($number)) {
            return '';
        }

        // Handle zero
        if ($number == 0) {
            return "Zero Rupees Only";
        }

        // Handle negative values
        $negative = $number < 0 ? "Negative " : "";
        $number = abs($number);

        $no = floor($number);
        $point = round($number - $no, 2) * 100;

        $hundreds = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = [];

        $words = [
            0 => '',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine',
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen',
            20 => 'Twenty',
            30 => 'Thirty',
            40 => 'Forty',
            50 => 'Fifty',
            60 => 'Sixty',
            70 => 'Seventy',
            80 => 'Eighty',
            90 => 'Ninety'
        ];

        $digits = [
            '', 'Hundred', 'Thousand', 'Lakh', 'Crore'
        ];

        // Core logic
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $numberChunk = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;

            if ($numberChunk) {
                $counter = count($str);
                $plural = ($counter && $numberChunk > 9) ? '' : null;
                $hundreds = ($counter == 1 && $str[0]) ? ' and ' : null;

                if ($numberChunk < 21) {
                    $temp = $words[$numberChunk] . " " . $digits[$counter] . $plural . " " . $hundreds;
                } else {
                    $temp = $words[floor($numberChunk / 10) * 10] . " " . $words[$numberChunk % 10] . " " . $digits[$counter] . $plural . " " . $hundreds;
                }

                $str[] = $temp;
            } else {
                $str[] = null;
            }
        }

        $rupees = implode('', array_reverse($str));
        $rupees = trim($rupees);

        // Handle paise
        $paise = "";
        if ($point > 0) {
            $paiseWords = "";
            if ($point < 21) {
                $paiseWords = $words[$point];
            } else {
                $paiseWords = $words[floor($point / 10) * 10] . " " . $words[$point % 10];
            }

            $paise = "And " . trim($paiseWords) . " Paise ";
        }

        // Final output
        return trim($negative . $rupees . " Rupees " . $paise . "Only");
    }


    /**
     * Format a number with Indian commas
     * Example: 15250 => 15,250
     */
    public static function formatIndian($number, $decimals = 2)
    {
        if (!is_numeric($number)) {
            return $number;
        }

        $negative = $number < 0 ? "-" : "";
        $number = abs($number);

        $decimalPart = "";
        if (strpos($number, '.') !== false) {
            $parts = explode('.', $number);
            $number = $parts[0];
            $decimalPart = "." . substr($parts[1], 0, $decimals);
        }

        $number = (string) $number;

        if (strlen($number) <= 3) {
            return $negative . $number . $decimalPart;
        }

        $lastThree = substr($number, -3);
        $rest = substr($number, 0, -3);
        $rest = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $rest);

        return $negative . $rest . "," . $lastThree . $decimalPart;
    }
}
