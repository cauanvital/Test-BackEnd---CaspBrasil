<?php

namespace App\Http\Controllers;

use App\Models\Nfe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NfeController extends Controller
{
    public function show($id)
    {
        // Versão que faz query no banco
        // $result = DB::table('nfes')
        //     ->join('produtos', 'nfes.id', '=', 'produtos.nfe_id')
        //     ->select(
        //         'nfes.id as id_nfe',
        //         'nfes.nr_nfe',
        //         'produtos.id as id_produto',
        //         'produtos.ds_produto',
        //         'produtos.nr_quantidade'
        //     )
        //     ->where('nfes.id', $id)
        //     ->get();

        // Versão com dados estáticos
        $result = [
            ["id_nfe" => 1, "nr_nfe" => 9998, "id_produto" => 1, "ds_produto" => "Notebook Dell", "nr_quantidade" => 1],
            ["id_nfe" => 1, "nr_nfe" => 9998, "id_produto" => 2, "ds_produto" => "Monitor Dell", "nr_quantidade" => 2],
            ["id_nfe" => 1, "nr_nfe" => 9998, "id_produto" => 3, "ds_produto" => "Kit Mouse + Teclado Dell", "nr_quantidade" => 1]
        ];

        // Checa por resultado vazio
        if (empty($result)) {
            return response()->json(['message' => 'NFe não encontrada'], 404);
        }

        // Monta o JSON da versão que busca no banco de fato
        // $json = [
        //     "id_nfe" => $result[0]->id_nfe,
        //     "nr_nfe" => $result[0]->nr_nfe,
        //     "nr_quantidade_produto" => 0, // Inicia em zero para somar depois
        //     "produtos" => []
        // ];

        // foreach ($result as $item) {
        //     $json['produtos'][] = [
        //         "id_produto" => $item->id_produto,
        //         "ds_produto" => $item->ds_produto,
        //         "nr_quantidade" => $item->nr_quantidade
        //     ];
        //     $json['nr_quantidade_produto'] += $item->nr_quantidade;
        // }

        // Agrupa dados
        $json = [
            "id_nfe" => $result[0]['id_nfe'],
            "nr_nfe" => $result[0]['nr_nfe'],
            "nr_quantidade_produto" => 0,
            "produtos" => []
        ];

        foreach ($result as $item) {
            $json['produtos'][] = [
                "id_produto" => $item['id_produto'],
                "ds_produto" => $item['ds_produto'],
                "nr_quantidade" => $item['nr_quantidade'],
            ];
            // Soma a quantidade total
            $json['nr_quantidade_produto'] += $item['nr_quantidade'];
        }

        // Exibindo retornando JSON
        return response()->json($json);
    }
}
