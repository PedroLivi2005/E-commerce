<?php

class Geral {

    //Fazer método para formatar data

    public static function converterDataTela(?string $data): ?string
    {
        if (empty($data)) {
            return null; // Ou return '' caso prefira tratar como string vazia na view
        }

        // Se a data já estiver formatada com barra (DD/MM/AAAA), apenas devolve
        if (strpos($data, '/') !== false) {
            return $data;
        }

        $timestamp = strtotime($data);

        // Se o strtotime não conseguir converter a data, retorna null
        if (!$timestamp) {
            return null;
        }

        return date('d/m/Y', $timestamp);
    }

    public static function converterDataBanco(?string $data): ?string
    {
        if (empty($data)) {
            return null;
        }

        // Se vier com barras (DD/MM/AAAA)
        if (strpos($data, '/') !== false) {
            $dataObj = DateTime::createFromFormat('d/m/Y', $data);
            if ($dataObj) {
                return $dataObj->format('Y-m-d');
            }
        }

        // Se já vier com hífen (AAAA-MM-DD ou input type="date")
        return $data;
    }

}



