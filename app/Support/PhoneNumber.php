<?php

namespace App\Support;

class PhoneNumber
{
    /**
     * Normalisasi nomor telepon ke format internasional untuk link wa.me
     * (mis. 0878-9147-2177 -> 6287891472177).
     */
    public static function waNumber(?string $number): ?string
    {
        if (! $number) {
            return null;
        }

        $digits = preg_replace('/[^0-9]/', '', $number);

        if (str_starts_with($digits, '0')) {
            $digits = '62'.substr($digits, 1);
        }

        return $digits;
    }
}
