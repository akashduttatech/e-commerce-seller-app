<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $view["title"] = "Users";
        $view["userName"] = auth()->user()->name;
        $view["search"] = $request->input('search') ?? "";
        if ($view["search"]) {
            $users = User::where('name', 'LIKE', '%' . $view["search"] . '%')->paginate(10);
        } else {
            $users = DB::table('users')
                ->select('users.name', 'users.email', 'users.created_at')
                ->paginate(10);
        }
        $view["users"] = $users;
        // $totalPrice = 0;
        // $totalQuantity = 0;
        // $view["totalProducts"] = count($products);
        // foreach ($products as $product) {
        //     $totalPrice += $product->price;
        //     $totalQuantity += $product->available_item_count;
        // }
        // $averagePrice = ($view["totalProducts"] > 0) ? $totalPrice / $view["totalProducts"] : 0;
        // $view["averagePrice"] = number_format($averagePrice, 2);
        // $view["totalQuantity"] = $totalQuantity;
        return view("admin.product.products", $view);
    }
}
