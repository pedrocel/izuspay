<?php

namespace App\Http\Controllers;

use App\Models\Association;
use Illuminate\Http\Request;

class PublicPageController extends Controller
{
    public function showAssociationLp(string $slug)
    {
        $association = Association::where('slug', $slug)
            ->with(['plans' => function ($query) {
                // Carrega apenas os planos ativos para a LP
                $query->where('is_active', true)->with('products');
            }])
            ->firstOrFail();

        return view('lp', compact('association'));
    }
}