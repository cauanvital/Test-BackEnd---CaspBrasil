<?php

namespace App\Http\Controllers;

use App\Models\Nfe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NfeController extends Controller
{
    public function show($id)
    {
        // Simulação do resultado do Inner Join (conforme solicitado)
        $result = [
            ["id_nfe" => 1, "nr_nfe" => 9998, "id_produto" => 1, "ds_produto" => "Produto 1", "nr_quantidade" => 1],
            ["id_nfe" => 1, "nr_nfe" => 9998, "id_produto" => 2, "ds_produto" => "Produto 2", "nr_quantidade" => 2],
            ["id_nfe" => 1, "nr_nfe" => 9998, "id_produto" => 3, "ds_produto" => "Produto 2", "nr_quantidade" => 1]
        ];

        // Transformação dos dados pra JSON
        if (empty($result)) {
            return response()->json(['message' => 'NFe não encontrada'], 404);
        }

        // Agrupar dados
        $formatado = [
            "id_nfe" => $result[0]['id_nfe'],
            "nr_nfe" => $result[0]['nr_nfe'],
            "nr_quantidade_produto" => 0,
            "produtos" => []
        ];

        foreach ($result as $item) {
            $formatado['produtos'][] = [
                "id_produto" => $item['id_produto'],
                "ds_produto" => $item['ds_produto'],
                "nr_quantidade" => $item['nr_quantidade'],
            ];
            // Soma a quantidade total
            $formatado['nr_quantidade_produto'] += $item['nr_quantidade'];
        }

        // Exibindo com var_dump ou retornando JSON
        return response()->json($formatado);
    }
}
