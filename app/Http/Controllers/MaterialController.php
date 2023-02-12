<?php

namespace App\Http\Controllers;

use App\Services\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    private Material $materialServ;

    public function __construct(Material $materialServ)
    {
        $this->materialServ = $materialServ;
    }

    public function create(Request $request)
    {
        $data = $this->materialServ->create(
            $request->input('title'),
            $request->input('styles'),
            $request->input('tag'),
            $request->input('describe'),
            $request->input('resourceUrl'),
        );

        return response()->json($data);
    }
}
