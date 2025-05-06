<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Vendor;
use Illuminate\Http\Request;

class MenusRecomenderController extends Controller
{
    public function index(Request $request){
        function calculateMagnitude($vector)
        {
            return sqrt(array_sum(array_map(fn($v) => $v ** 2, $vector)));
        }

        function calculateDotProduct($vector1, $vector2)
        {
            return array_sum(array_map(fn($a, $b) => $a * $b, $vector1, $vector2));
        }

        function cosineSimilarity($vector1, $vector2)
        {
            $dotProduct = calculateDotProduct($vector1, $vector2);
            $magnitude1 = calculateMagnitude($vector1);
            $magnitude2 = calculateMagnitude($vector2);

            return ($magnitude1 * $magnitude2) ? $dotProduct / ($magnitude1 * $magnitude2) : 0;
        }

        $menus = Menu::all();
        $recommendations = [];

        if ($request->has('menu_id')) {
            $menuTarget = Menu::find($request->menu_id);

            if ($menuTarget) {
                $targetVector = [
                    strtolower($menuTarget->karbohidrat),
                    strtolower($menuTarget->protein),
                    strtolower($menuTarget->sayur),
                    strtolower($menuTarget->buah),
                    strtolower($menuTarget->kategori_bahan_utama),
                    $menuTarget->vendor_id
                ];

                foreach ($menus as $menu) {
                    $inputVector = [
                        strtolower($menu->karbohidrat),
                        strtolower($menu->protein),
                        strtolower($menu->sayur),
                        strtolower($menu->buah),
                        strtolower($menu->kategori_bahan_utama),
                        $menu->vendor_id
                    ];

                    $A = [];
                    for ($i = 0; $i < count($targetVector); $i++) {
                        $A[] = ($targetVector[$i] == $inputVector[$i]) ? 1 : 0;
                    }

                    $C = [1, 1, 1, 1, 1, 1];

                    // Hitung Cosine Similarity
                    $similarity = cosineSimilarity($A, $C);

                    $recommendations[$menu->id] = $similarity;
                }

                // Urutkan menu berdasarkan similarity (dari besar ke kecil)
                arsort($recommendations);

                // Ambil hanya menu yang memiliki similarity > 0
                $menus = $menus->whereIn('id', array_keys($recommendations))
                                ->sortByDesc(fn($menu) => $recommendations[$menu->id]);
            }
        }

        return view('menus-recommender.index', compact('menus', 'recommendations'));
    }

    public function generateDeck()
    {
        // $menus = Menu::all();
        // $recommendations = [];

        // // Ambil menu target default atau acak
        // $menuTarget = Menu::inRandomOrder()->first();

        // if ($menuTarget) {
        //     $targetVector = [
        //         strtolower($menuTarget->karbohidrat),
        //         strtolower($menuTarget->protein),
        //         strtolower($menuTarget->sayur),
        //         strtolower($menuTarget->buah),
        //         strtolower($menuTarget->kategori_bahan_utama),
        //         $menuTarget->vendor_id
        //     ];

        //     foreach ($menus as $menu) {
        //         $inputVector = [
        //             strtolower($menu->karbohidrat),
        //             strtolower($menu->protein),
        //             strtolower($menu->sayur),
        //             strtolower($menu->buah),
        //             strtolower($menu->kategori_bahan_utama),
        //             $menu->vendor_id
        //         ];

        //         $A = [];
        //         for ($i = 0; $i < count($targetVector); $i++) {
        //             $A[] = ($targetVector[$i] == $inputVector[$i]) ? 1 : 0;
        //         }

        //         $C = [1, 1, 1, 1, 1, 1];
        //         $similarity = cosineSimilarity($A, $C);

        //         $recommendations[$menu->id] = $similarity;
        //     }

        //     arsort($recommendations);

        //     $recommendedMenus = Menu::whereIn('id', array_keys($recommendations))
        //         ->get()
        //         ->sortByDesc(fn($menu) => $recommendations[$menu->id])
        //         ->values();

        //     // Ambil 7 menu teratas untuk 7 hari
        //     $days = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
        //     $deckMenus = [];
        //     foreach ($days as $i => $day) {
        //         if (isset($recommendedMenus[$i])) {
        //             $deckMenus[$day] = $recommendedMenus[$i];
        //         }
        //     }

        //     return view('menus-recommender.index1', compact('deckMenus'));
        // }

        // return redirect()->back()->with('error', 'Menu target tidak ditemukan');
    }



    public function create(String $menuId)
    {
        return view('menus-deck.create', [
            'vendors' => Vendor::all(),
            'menuId' => $menuId
        ]);
    }
}
