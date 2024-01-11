<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $view["title"] = "Products";
        $view["userName"] = auth()->user()->name;
        $view["search"] = $request->input('search') ?? "";
        if ($view["search"]) {
            $products = Product::where('name', 'LIKE', '%' . $view["search"] . '%')->paginate(10);
        } else {
            $products = DB::table('products')
                ->join('users', 'products.seller', '=', 'users.id')
                ->select('products.*', 'users.email')
                ->paginate(10);
        }
        $view["products"] = $products;
        $totalPrice = 0;
        $totalQuantity = 0;
        $view["totalProducts"] = count($products);
        foreach ($products as $product) {
            $totalPrice += $product->price;
            $totalQuantity += $product->available_item_count;
        }
        $averagePrice = ($view["totalProducts"] > 0) ? $totalPrice / $view["totalProducts"] : 0;
        $view["averagePrice"] = number_format($averagePrice, 2);
        $view["totalQuantity"] = $totalQuantity;
        return view("admin.product.products", $view);
    }

    public function create(Request $request)
    {
        /* get product categories */
        $categories = ProductCategory::select('name')->get();
        $view["categories"] = $categories;
        $view["title"] = "Add Product";
        $view["userName"] = auth()->user()->name;
        return view("admin.product.add-product", $view);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product' => 'required',
            'category' => 'required',
            'price' => 'required|numeric|between:0,999999.99',
            'quantity' => 'nullable|numeric',
            'description' => 'nullable',
        ]);
        $validated = $validator->validated();
        $response = Product::create([
            'name' => $validated['product'],
            'category' => $validated['category'],
            'price' => $validated['price'],
            'available_item_count' => $validated['quantity'] ?? 0,
            'description' => $validated['description'] ?? '',
            'seller' => auth()->user()->id,
        ]);
        if ($response) {
            return redirect()->route('admin.products')->with('success', 'Product created successfully');
        }
        return redirect()->route('admin.products')->with('failed', 'Oops! Product creation was unsuccessful');
    }

    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            $view['product'] = $product;
            $view["title"] = "Product";
            $view["userName"] = auth()->user()->name;
            return view("admin.product.view-product", $view);
        }
        return redirect()->route('admin.products')->with('failed', 'The requested product doesn"t exist');
    }

    public function edit($id)
    {
        /* get product */
        $product = Product::find($id);
        if ($product) {
            $view['product'] = $product;
            /* get product categories */
            $categories = ProductCategory::select('name')->get();
            $view["categories"] = $categories;
            $view["title"] = "Edit Product";
            $view["userName"] = auth()->user()->name;
            return view("admin.product.edit-product", $view);
        }
        return redirect()->route('admin.products')->with('failed', 'The requested product doesn"t exist');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'product' => 'required',
            'category' => 'required',
            'price' => 'required|numeric|between:0,999999.99',
            'quantity' => 'nullable|numeric',
            'description' => 'nullable',
        ]);
        $validated = $validator->validated();
        $product = Product::find($id);
        if ($product) {
            $response = Product::where('id', $id)->update([
                'name' => $validated['product'],
                'category' => $validated['category'],
                'price' => $validated['price'],
                'available_item_count' => $validated['quantity'] ?? 0,
                'description' => $validated['description'] ?? '',
                'seller' => auth()->user()->id,
            ]);
            if ($response) {
                return redirect()->route('admin.products')->with('success', 'Products updated successfully');
            }
            return redirect()->route('admin.products')->with('failed', 'Oops! Product updation was unsuccessful');
        }
        return redirect()->route('admin.products')->with('failed', 'The requested product doesn"t exist');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $response = $product->delete();
            if ($response) {
                return redirect()->route('admin.products')->with('success', 'Product deleted successfully');
            }
            return redirect()->route('admin.products')->with('failed', 'Oops! Unable to delete the product');
        }
        return redirect()->route('admin.products')->with('failed', 'The requested product doesn"t exist');
    }
}
