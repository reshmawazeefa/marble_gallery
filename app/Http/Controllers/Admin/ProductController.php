<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::select('*')->with('category');
            if(!empty($request->category))
                $data->where('categoryCode', $request->category);
            if(!empty($request->subcategory))
                $data->where('subCateg', $request->subcategory);
            if(!empty($request->type))
                $data->where('type', $request->type);
            if(!empty($request->brand))
                $data->where('brand', $request->brand);
            if(!empty($request->size))
                $data->where('size', $request->size);
            if(!empty($request->color))
                $data->where('color', $request->color);
            if(!empty($request->finish))
                $data->where('finish', $request->finish);

            return Datatables::of($data)
            ->addColumn('image', function ($row){
                    if(!empty($row->image))
                        $image = request()->getSchemeAndHttpHost().'/assets/images/products/'.$row->image;

                    else
                        $image = $row->image;                    
                    
                    return  '<img style="max-height:100px" src=" '.$image.' "/>';
                })
                ->addColumn('action', function($row){
                    $url = url('admin/products/'.$row->id);
                    $btn = '<a href='.$url.' class="edit btn btn-primary btn-sm">View</a>';
    
                        return $btn;
                })
                ->rawColumns(['action','image'])
                ->make(true);
        }
        
        return view('admin.products');
    }

    public function show($product)
    {
        $details = Product::with('category')->find($product); //print_r($details);
        return view('admin.product_details', compact('details'));
        
        //print_r($details);
    }

    public function get_categories(Request $request)//get Partners
    {
        $data = [];
        $page = $request->page;
        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;
        /** search the users by name,phone and email**/
        if ($request->has('q') && $request->q!= '') {
            $search = $request->q;
            $data = Category::select("categoryCode","categoryName")
            ->orWhere('categoryName','LIKE',"%$search%")->skip($offset)->take($resultCount)->get();

            $count = Category::select("categoryCode","categoryName")
            ->orWhere('categoryName','LIKE',"%$search%")->count();

        }
        else{
        /** get the users**/
        $data = Category::with('products')->skip($offset)->take($resultCount)->get();

        $count =Category::select("categoryCode","categoryName")->count();
        }
        /**set pagination**/
        $endCount = $offset + $resultCount;
        if($endCount >= $count)
            $morePages = false;
        else
            $morePages = true;
            
        $result = array(
        "data" => $data,
        "pagination" => array(
        "more" => $morePages
        )
        );
        return response()->json($result);
       
    }

    public function get_subcategories(Request $request)//get Partners
    {
        $data = [];
        $page = $request->page;
        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;
        /** search the users by name,phone and email**/
        if ($request->has('q') && $request->q!= '') {
            $search = $request->q;
            $data = Product::select("subCateg")
            ->orWhere('subCateg','LIKE',"%$search%")->groupBy("subCateg")->skip($offset)->take($resultCount)->get();

            $count = Product::select("subCateg")
            ->orWhere('subCateg','LIKE',"%$search%")->groupBy("subCateg")->count();

        }
        else{
        /** get the users**/
        $data = Product::select("subCateg")->groupBy("subCateg")->skip($offset)->take($resultCount)->get();

        $count =Product::select("subCateg")->groupBy("subCateg")->count();
        }
        /**set pagination**/
        $endCount = $offset + $resultCount;
        if($endCount >= $count)
            $morePages = false;
        else
            $morePages = true;
            
        $result = array(
        "data" => $data,
        "pagination" => array(
        "more" => $morePages
        )
        );
        return response()->json($result);
       
    }

    public function get_types(Request $request)//get Partners
    {
        $data = [];
        $page = $request->page;
        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;
        /** search the users by name,phone and email**/
        if ($request->has('q') && $request->q!= '') {
            $search = $request->q;
            $data = Product::select("type")
            ->orWhere('type','LIKE',"%$search%")->groupBy("type")->skip($offset)->take($resultCount)->get();

            $count = Product::select("type")
            ->orWhere('type','LIKE',"%$search%")->groupBy("type")->count();

        }
        else{
        /** get the users**/
        $data = Product::select("type")->groupBy("type")->skip($offset)->take($resultCount)->get();

        $count =Product::select("type")->groupBy("type")->count();
        }
        /**set pagination**/
        $endCount = $offset + $resultCount;
        if($endCount >= $count)
            $morePages = false;
        else
            $morePages = true;
            
        $result = array(
        "data" => $data,
        "pagination" => array(
        "more" => $morePages
        )
        );
        return response()->json($result);
       
    }
    
    public function get_brands(Request $request)//get Partners
    {
        $data = [];
        $page = $request->page;
        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;
        /** search the users by name,phone and email**/
        if ($request->has('q') && $request->q!= '') {
            $search = $request->q;
            $data = Product::select("brand")
            ->orWhere('brand','LIKE',"%$search%")->groupBy("brand")->skip($offset)->take($resultCount)->get();

            $count = Product::select("brand")
            ->orWhere('brand','LIKE',"%$search%")->groupBy("brand")->count();

        }
        else{
        /** get the users**/
        $data = Product::select("brand")->groupBy("brand")->skip($offset)->take($resultCount)->get();

        $count =Product::select("brand")->groupBy("brand")->count();
        }
        /**set pagination**/
        $endCount = $offset + $resultCount;
        if($endCount >= $count)
            $morePages = false;
        else
            $morePages = true;
            
        $result = array(
        "data" => $data,
        "pagination" => array(
        "more" => $morePages
        )
        );
        return response()->json($result);
       
    }

    public function get_sizes(Request $request)//get Partners
    {
        $data = [];
        $page = $request->page;
        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;
        /** search the users by name,phone and email**/
        if ($request->has('q') && $request->q!= '') {
            $search = $request->q;
            $data = Product::select("size")
            ->orWhere('size','LIKE',"%$search%")->groupBy("size")->skip($offset)->take($resultCount)->get();

            $count = Product::select("size")
            ->orWhere('size','LIKE',"%$search%")->groupBy("size")->count();

        }
        else{
        /** get the users**/
        $data = Product::select("size")->groupBy("size")->skip($offset)->take($resultCount)->get();

        $count =Product::select("size")->groupBy("size")->count();
        }
        /**set pagination**/
        $endCount = $offset + $resultCount;
        if($endCount >= $count)
            $morePages = false;
        else
            $morePages = true;
            
        $result = array(
        "data" => $data,
        "pagination" => array(
        "more" => $morePages
        )
        );
        return response()->json($result);
       
    }

    public function get_colors(Request $request)//get Partners
    {
        $data = [];
        $page = $request->page;
        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;
        /** search the users by name,phone and email**/
        if ($request->has('q') && $request->q!= '') {
            $search = $request->q;
            $data = Product::select("color")
            ->orWhere('color','LIKE',"%$search%")->groupBy("color")->skip($offset)->take($resultCount)->get();

            $count = Product::select("color")
            ->orWhere('color','LIKE',"%$search%")->groupBy("color")->count();

        }
        else{
        /** get the users**/
        $data = Product::select("color")->groupBy("color")->skip($offset)->take($resultCount)->get();

        $count =Product::select("color")->groupBy("color")->count();
        }
        /**set pagination**/
        $endCount = $offset + $resultCount;
        if($endCount >= $count)
            $morePages = false;
        else
            $morePages = true;
            
        $result = array(
        "data" => $data,
        "pagination" => array(
        "more" => $morePages
        )
        );
        return response()->json($result);
       
    }

    public function get_finish(Request $request)//get Partners
    {
        $data = [];
        $page = $request->page;
        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;
        /** search the users by name,phone and email**/
        if ($request->has('q') && $request->q!= '') {
            $search = $request->q;
            $data = Product::select("finish")
            ->orWhere('finish','LIKE',"%$search%")->groupBy("finish")->skip($offset)->take($resultCount)->get();

            $count = Product::select("finish")
            ->orWhere('finish','LIKE',"%$search%")->groupBy("finish")->count();

        }
        else{
        /** get the users**/
        $data = Product::select("finish")->groupBy("finish")->skip($offset)->take($resultCount)->get();

        $count =Product::select("finish")->groupBy("finish")->count();
        }
        /**set pagination**/
        $endCount = $offset + $resultCount;
        if($endCount >= $count)
            $morePages = false;
        else
            $morePages = true;
            
        $result = array(
        "data" => $data,
        "pagination" => array(
        "more" => $morePages
        )
        );
        return response()->json($result);
       
    }    

    public function upload_product_image(Request $request)
    {
        $product = Product::find($request->product_id); 
        $product->image = $imageName = time().'_'.$product->productCode.".jpg";
        $request->image->move(public_path('/assets/images/products'), $imageName);
        $product->save();
        return redirect('admin/products/'.$request->product_id);
    }
}
