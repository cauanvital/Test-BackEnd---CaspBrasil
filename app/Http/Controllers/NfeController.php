<?php

namespace App\Http\Controllers;

use App\Models\Nfe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NfeController extends Controller
{
    public function show($id)
    {
        // Query com join no banco
        $result = DB::table('nfes')
            ->join('produtos', 'nfes.id', '=', 'produtos.nfe_id')
            ->select(
                'nfes.id as id_nfe',
                'nfes.nr_nfe',
                'produtos.id as id_produto',
                'produtos.ds_produto',
                'produtos.nr_quantidade'
            )
            ->where('nfes.id', $id)
            ->get();

        // Transformação dos dados pra JSON
        if (empty($result)) {
            return response()->json(['message' => 'NFe não encontrada'], 404);
        }

        // Monta o JSON
        $json = [
            "id_nfe" => $result[0]->id_nfe,
            "nr_nfe" => $result[0]->nr_nfe,
            "nr_quantidade_produto" => 0, // Inicia em zero para somar depois
            "produtos" => []
        ];

        foreach ($result as $item) {
            $json['produtos'][] = [
                "id_produto" => $item->id_produto,
                "ds_produto" => $item->ds_produto,
                "nr_quantidade" => $item->nr_quantidade
            ];
            // Soma a quantidade total de produtos
            $json['nr_quantidade_produto'] += $item->nr_quantidade;
        }

        // Exibindo retornando JSON
        return response()->json($json);
    }
}
