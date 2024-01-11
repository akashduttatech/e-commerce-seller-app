<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        $view["title"] = "Product Categories";
        $view["userName"] = auth()->user()->name;
        $view["search"] = $request->input('search') ?? "";
        if ($view["search"]) {
            $categories = ProductCategory::where('name', 'LIKE', '%' . $view["search"] . '%')->paginate(10);
        } else {
            $categories = DB::table('product_categories')
                ->join('users', 'product_categories.user_id', '=', 'users.id')
                ->select('product_categories.*', 'users.email')
                ->paginate(10);
        }
        $view["categories"] = $categories;
        return view("admin.product.categories", $view);
    }

    public function create(Request $request)
    {
        $view["title"] = "Add Product Category";
        $view["userName"] = auth()->user()->name;
        return view("admin.product.add-category", $view);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|regex:/^[\pL\s]+$/u|unique:App\Models\ProductCategory,name',
            'description' => 'required|regex:/^[\pL\s\d]+$/u'
        ]);
        $validated = $validator->validated();
        $response = ProductCategory::create([
            'name' => $validated['category'],
            'description' => $validated['description'],
            'user_id' => auth()->user()->id,
        ]);
        if ($response) {
            return redirect()->route('admin.categories')->with('success', 'Category created successfully');
        }
        return redirect()->route('admin.categories')->with('failed', 'Oops! Category creation was unsuccessful');
    }

    public function show($id)
    {
        $category = ProductCategory::find($id);
        if ($category) {
            $view['category'] = $category;
            $view["title"] = "Product Category";
            $view["userName"] = auth()->user()->name;
            return view("admin.product.view-category", $view);
        }
        return redirect()->route('admin.categories')->with('failed', 'The requested category doesn"t exist');
    }

    public function edit($id)
    {
        $category = ProductCategory::find($id);
        if ($category) {
            $view['category'] = $category;
            $view["title"] = "Edit Product Category";
            $view["userName"] = auth()->user()->name;
            return view("admin.product.edit-category", $view);
        }
        return redirect()->route('admin.categories')->with('failed', 'The requested category doesn"t exist');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'regex:/^[\pL\s]+$/u',
            'description' => 'regex:/^[\pL\s\d]+$/u',
        ]);
        $validated = $validator->validated();
        $category = ProductCategory::find($id);
        if ($category) {
            $response = ProductCategory::where('id', $id)->update([
                'name' => $validated['category'],
                'description' => $validated['description'],
                'user_id' => auth()->user()->id,
            ]);
            if ($response) {
                return redirect()->route('admin.categories')->with('success', 'Category updated successfully');
            }
            return redirect()->route('admin.categories')->with('failed', 'Oops! Category updation was unsuccessful');
        }
        return redirect()->route('admin.categories')->with('failed', 'The requested category doesn"t exist');
    }

    public function destroy($id)
    {
        $category = ProductCategory::find($id);
        if ($category) {
            $response = $category->delete();
            if ($response) {
                return redirect()->route('admin.categories')->with('success', 'Category deleted successfully');
            }
            return redirect()->route('admin.categories')->with('failed', 'Oops! Unable to delete the category');
        }
        return redirect()->route('admin.categories')->with('failed', 'The requested category doesn"t exist');
    }
}
