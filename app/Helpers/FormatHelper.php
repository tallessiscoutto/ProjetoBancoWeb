<?php

namespace App\Helpers;

class FormatHelper
{
    public static function formatarDocumento($documento) {
        $doc = preg_replace('/[^0-9]/', '', $documento);
        if (strlen($doc) === 11) {
            return substr($doc, 0, 3) . '.' . substr($doc, 3, 3) . '.' . substr($doc, 6, 3) . '-' . substr($doc, 9);
        } else {
            return substr($doc, 0, 2) . '.' . substr($doc, 2, 3) . '.' . substr($doc, 5, 3) . '/' . substr($doc, 8, 4) . '-' . substr($doc, 12);
        }
    }

    public static function formatarTelefone($telefone) {
        $tel = preg_replace('/[^0-9]/', '', $telefone);
        if (strlen($tel) === 11) {
            return '(' . substr($tel, 0, 2) . ') ' . substr($tel, 2, 5) . '-' . substr($tel, 7);
        } else {
            return '(' . substr($tel, 0, 2) . ') ' . substr($tel, 2, 4) . '-' . substr($tel, 6);
        }
    }
} 