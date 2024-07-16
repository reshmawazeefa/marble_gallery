<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Partner;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\ProductPrice;
use App\Models\Quotation;
use App\Models\CustomQuotation;
use App\Models\QuotationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class QuotationController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        
    }

    public function create()
    {
        return view('admin.create_quotation');
    }

    public function edit($id)
    {
        $details = Quotation::select('quotations.*')->with(array('Items.products.stock','customer','referral1','referral2','referral3'))->find($id); 
        //echo(json_encode($details));
       
        return view('admin.edit_quotation', compact('details'));
    }

    public function get_users(Request $request)//get Users
    {
        $data = [];
        $page = $request->page;
        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;
        /** search the users by name,phone and email**/
        if ($request->has('q') && $request->q!= '') {
            $search = $request->q;
            $data = User::select("*")
            ->orWhere('name','LIKE',"%$search%")
            ->orWhere('email','LIKE',"%$search%")->skip($offset)->take($resultCount)->get();

            $count = User::select("id","phone","name")
            ->orWhere('name','LIKE',"%$search%")
            ->orWhere('email','LIKE',"%$search%")->count();
        }
        else{
        /** get the users**/
        $data = User::select("*")->skip($offset)->take($resultCount)->get();
        $count =User::select("id","phone","name")->count();
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
    
    public function get_customers(Request $request)//get Customers
    {
        $data = [];
        $page = $request->page;
        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;
        /** search the users by name,phone and email**/
        if ($request->has('q') && $request->q!= '') {
            $search = $request->q;
            $data = Customer::select("*")->where('is_active',1)
            ->where(function($query) use ($search){$query->where('name','LIKE',"%$search%")
            ->orWhere('phone','LIKE',"%$search%");
            })
            ->skip($offset)->take($resultCount)->get();

            $count = Customer::select("id","phone","name")
            ->where('is_active',1)
            ->where(function($query) use ($search){$query->where('name','LIKE',"%$search%")
            ->orWhere('phone','LIKE',"%$search%");
            })->count();

        }
        else{
        /** get the users**/
        $data = Customer::select("*")->where('is_active',1)->skip($offset)->take($resultCount)->get();

        $count =Customer::select("id","phone","name")->where('is_active',1)->count();
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
    
    public function get_partners(Request $request, $type)//get Partners
    {
        $data = [];
        $page = $request->page;
        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;
        /** search the users by name,phone and email**/
        if ($request->has('q') && $request->q!= '') {
            $search = $request->q;
            $data = Partner::select("*")->where('partner_type',$type)
            ->where(function ($query) use ($search) {
                $query->where('name','LIKE',"%$search%")
                      ->orWhere('phone','LIKE',"%$search%");
            })->skip($offset)->take($resultCount)->get();

            $count = Partner::select("id","phone","name")->where('partner_type',$type)
            ->where(function ($query) use ($search) {
                $query->where('name','LIKE',"%$search%")
                      ->orWhere('phone','LIKE',"%$search%");
            })->count();

        }
        else{
        /** get the users**/
        $data = Partner::select("*")->where('partner_type',$type)->skip($offset)->take($resultCount)->get();

        $count =Partner::select("id","phone","name")->where('partner_type',$type)->count();
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
    
    public function get_products(Request $request)//get Products
    {
        $data = [];
        $page = $request->page;
        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;
        /** search the products by name**/
        if ($request->has('q') && $request->q!= '') {
            $search = $request->q;
            $data = Product::select("productCode","productName")
            ->where('is_active','Y')
            ->where(function ($query) use ($search) {
                $query->where('productName','LIKE',"%$search%")
                      ->orWhere('productCode','LIKE',"%$search%");
            })->skip($offset)->with('category','stock.warehouse')->take($resultCount)->get();

            $count = Product::select("id","phone","name")
            ->where('is_active','Y')
            ->where(function ($query) use ($search) {
                $query->where('productName','LIKE',"%$search%")
                      ->orWhere('productCode','LIKE',"%$search%");
            })->count();

        }
        else{
        /** get the users**/
        $data = Product::select("productCode","productName")->where('is_active','Y')->with('category','stock.warehouse')->skip($offset)->take($resultCount)->get();

        $count =Product::select("productCode","productName")->where('is_active','Y')->count();
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

    public function get_warehouses(Request $request)
    {
        $data = [];
        $page = $request->page;
        $productCode = $request->productCode;
        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;
        /** search the products by name**/
        if ($request->has('q') && $request->q!= '') {
            $search = $request->q;
            $data = ProductStock::
            with('warehouse')->whereHas('warehouse', function ($query) use ($search) {
                $query->where('whsName','LIKE',"%$search%");
                $query->orWhere('whsCode','LIKE',"%$search%");
                return $query;
            })->where('productCode',$productCode)   
            ->skip($offset)->take($resultCount)->get();

            $count = ProductStock::select("*")->
            with(['warehouse' => function($query) use ($search) {
                $query->select('whsCode', 'whsName');
                $query->orWhere('whsName','LIKE',"%$search%");
                $query->orWhere('whsCode','LIKE',"%$search%");
            }])->where('productCode',$productCode)
            ->count();

        }
        else{
        /** get the users**/
        $data = ProductStock::select("*")->
        with(['warehouse','product'])->where('productCode',$productCode)->skip($offset)->take($resultCount)->get();

        $count =ProductStock::select("productCode","productName")->count();
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

    public function get_product_stock(Request $request)
    {
        $product = ProductStock::with('warehouse','product')->where('productCode',$request->productCode)->first();
        //->where('whsCode',$request->whsCode)
        $product['price_list'] = ProductPrice::where('productCode',$request->productCode)->first();
        return response()->json($product);
    }

    public function update(Request $request,$quotation_id)
    {
        $validator = $request->validate( [
            'product' => 'required|array|min:1',
            'quantity' => 'required|array|min:1']);
        $quotation = Quotation::find($quotation_id);
        $quotation->CustomerCode = $request->customer;
        //$quotation->user_id = Auth::user()->id;
        $quotation->Ref1 = $request->partner1;
        $quotation->Ref2 = $request->partner2;
        $quotation->Ref3 = $request->partner3;
        $quotation->DocDate = $request->date;
        $quotation->DueDate = $request->DueDate;
        $quotation->PriceList = $request->priceList;
        $quotation->VehType = $request->vehicle_type;
        $quotation->Distance = $request->km;
        $quotation->Remarks = $request->remarks;
        $quotation->DiscPrcnt = $request->discountPercent;
        $quotation->TaxAmount = $request->tax_amount;
        $quotation->DocTotal = $request->grand_total;
        $quotation->FreightCharge = $request->FreightCharge;
        $quotation->LoadingCharge = $request->LoadingCharge;
        $quotation->UnloadingCharge = $request->UnloadingCharge;
        $quotation->save();
        $products = $request->product; 
        $line_ids = $request->line_id; 
        $p = QuotationItem::whereNotIn('id', $line_ids)->where('quotation_id',$quotation_id)->delete();
        //print_r(($p)); exit;       
        $warehouses = $request->warehouse;        
        $quantity = $request->quantity;      
        $select_uom = $request->select_uom;      
        $disc_perct = $request->disc_perct; 
        $LineDiscPrice = $request->LineDiscPrice;
        $discount_type = $request->discount_type;  
        $LineTotal = $request->LineTotal;    
        $grandTotal = $request->grand_total;
        $area = $request->area;
        $count = count($products);
        $lineNo = 1;$grand_total = 0;
        for($i=0; $i<$count; $i++)
        {
            if(!$quantity[$i])
                $quantity[$i] = 1;
                
            if(!empty($products[$i]) && !empty($quantity[$i]) && !empty($warehouses[$i]))
            {
                $quotationItem = QuotationItem::where(array('quotation_id'=>$quotation_id,'id'=>$line_ids[$i]))->first();                
                $item = Product::where('productCode',$products[$i])->first();
                if(!empty($quotationItem))
                {
                    $price = $quotationItem->UnitPrice;
                    $taxRate = $quotationItem->TaxRate;
                }
                elseif(!empty($item))
                {
                    $quotationItem = new QuotationItem;
                    $quotationItem->quotation_id = $quotation_id;
                    $quotationItem->ItemCode = $products[$i];
                    $quotationItem->whsCode = $warehouses[$i];

                    $price_list = ProductPrice::where('productCode',$products[$i])->where('priceList',$request->priceList)->first();
                    $quotationItem->UnitPrice = $price = $price_list->price;
                    $quotationItem->TaxRate = $taxRate = $item->taxRate;
                }
                $quotationItem->Qty = $quantity[$i];
                $quotationItem->area = $area[$i];                
                $quotationItem->DiscType = $discount_type[$i];

                $quotationItem->UOM = $item->invUOM;
                if(!$item->sqft_Conv)
                    $item->sqft_Conv = 1;
                $item->sqft_Conv = round($item->sqft_Conv,3);
                $quotationItem->SqmtQty = $quantity[$i] * $item->conv_Factor;
                $quotationItem->SqftQty = $quantity[$i] * $item->sqft_Conv;
                
                if($discount_type[$i] == 'Percentage')
                {                            
                    $quotationItem->LineDiscPrcnt = $disc_perct[$i];
                    $quotationItem->PerSqftDisc = round($price/$item->sqft_Conv,4);  
                    $quotationItem->LineDiscPrice = round($LineDiscPrice[$i]*100/($taxRate+100),4); 
                    $quotationItem->PriceAfterDisc = round(($price - $price * $disc_perct[$i]/100) * $quantity[$i],2);
                }                           
                
                else
                {
                    $quotationItem->PerSqftDisc = round($disc_perct[$i]*100/($taxRate+100),4);  
                    $quotationItem->LineDiscPrice = round($LineDiscPrice[$i]*100/($taxRate+100),4);                      
                    $quotationItem->PriceAfterDisc = round($price * $quantity[$i] - $quotationItem->LineDiscPrice,2); 
                }
                $quotationItem->TaxAmount = round($quotationItem->PriceAfterDisc * $taxRate/100,2);
                $quotationItem->PriceAfterDisc = round($quotationItem->PriceAfterDisc/$quantity[$i],2);
                $quotationItem->LineTotal = round($LineTotal[$i] * 100/($taxRate+100),2);
                $grand_total = $grand_total + $quotationItem->LineTotal;
                $quotationItem->LineNo = $lineNo;
                $quotationItem->save();
                $lineNo++;
            }
        }
        if(!empty($taxRate))
            $quotation->DiscAmount = round($request->discount_amount*100/($taxRate+100),2);        
        else
            $quotation->DiscAmount = round($request->discount_amount,2);
        /*if(!empty($grandTotal) && !empty($taxRate))
        {
            $quotation->DocTotal = round($grandTotal * 100/($taxRate+100),2);
        }
        else
        {*/
            $DocTotal = $grand_total+$quotation->FreightCharge+$quotation->LoadingCharge+$quotation->UnloadingCharge;
            $quotation->DocTotal = round($DocTotal,2);
        //}
        $quotation->save();
        return redirect('admin/quotations/'.$quotation_id)->with('success','Quotation updated successfully');
    }    

    public function insert(Request $request)
    {
        $validator = $request->validate( ['customer' => 'required', 
            'product' => 'required|array|min:1',
            'quantity' => 'required|array|min:1']);
        $quotation = new Quotation;
        $quotation->CustomerCode = $request->customer;
        $quotation->createdBy = Auth::user()->id;
        $quotation->manager1 = Auth::user()->approver1;
        $quotation->manager2 = Auth::user()->approver2;
        $quotation->Ref1 = $request->partner1;
        $quotation->Ref2 = $request->partner2;
        $quotation->Ref3 = $request->partner3;
        $quotation->DocDate = $request->date;
        $quotation->DueDate = $request->DueDate;
        //$quotation->DocNo = date("Y").'-'.$request->docNumber;
        $lastQuotation = Quotation::orderBy('id','desc')->first();
        // dd($lastQuotation);
        $arrayQuotation = array();
        if($lastQuotation)
        {                
            $codeQuotation = $lastQuotation->DocNo;
            $arrayQuotation = explode('-',$codeQuotation);
        }
        if(count($arrayQuotation) > 1)
            $numQuotation = $arrayQuotation[1]+1;            
        else
            $numQuotation = 1;

        $last = CustomQuotation::orderBy('id','desc')->first();
        $array = array();
        if($last)
        {                
            $code = $last->DocNo;
            $array = explode('-',$code);
        }
        if(count($array) > 1)
            $numCustom = $array[1]+1;            
        else
            $numCustom = 1;
        if($numQuotation > $numCustom)
            $num = $numQuotation;
        else
            $num = $numCustom;
        /*if(strlen($num) < 7)
            $num = str_pad($num, 7, '0', STR_PAD_LEFT);*/
        $quotation->DocNo = date("Y").'-'.$num;
        $quotation->PriceList = $request->priceList;
        $quotation->VehType = $request->vehicle_type;
        $quotation->Distance = $request->km;
        $quotation->Remarks = $request->remarks;
        $quotation->DiscPrcnt = $request->discountPercent;
        $quotation->TaxAmount = $request->tax_amount;
        $quotation->FreightCharge = $request->FreightCharge;
        $quotation->LoadingCharge = $request->LoadingCharge;
        $quotation->UnloadingCharge = $request->UnloadingCharge;
        $quotation->save();
        $quotation_id = $quotation->id;
        $products = $request->product;        
        $warehouses = $request->warehouse;        
        $quantity = $request->quantity;      
        $select_uom = $request->select_uom;      
        $disc_perct = $request->disc_perct; 
        $LineDiscPrice = $request->LineDiscPrice;
        $discount_type = $request->discount_type;
        $LineTotal = $request->LineTotal;    
        $grandTotal = $request->grand_total;
        $area = $request->area;
        $count = count($products);
        $lineNo = 1; $grand_total = 0;  
        for($i=0; $i<$count; $i++)
        {
            if(!$quantity[$i])
                $quantity[$i] = 1;
            if(!empty($products[$i]) && !empty($quantity[$i]) && !empty($warehouses[$i]))
            {
                $quotationItem = new QuotationItem;
                $quotationItem->quotation_id = $quotation_id;
                $quotationItem->ItemCode = $products[$i];
                $quotationItem->whsCode = $warehouses[$i];
                $quotationItem->Qty = $quantity[$i];
                $quotationItem->area = $area[$i];
                $quotationItem->DiscType = $discount_type[$i];
                $item = Product::where('productCode',$products[$i])->first();
                if(!empty($item))
                {
                    $price_list = ProductPrice::where('productCode',$products[$i])->where('priceList',$request->priceList)->first();
                    $quotationItem->UOM = $item->invUOM;
                    if(!$item->sqft_Conv)
                        $item->sqft_Conv = 1;
                    $item->sqft_Conv = round($item->sqft_Conv,3);
                    $quotationItem->SqmtQty = $quantity[$i] * $item->conv_Factor;
                    $quotationItem->SqftQty = $quantity[$i] * $item->sqft_Conv;
                    if(!empty($price_list))
                    {
                        $quotationItem->UnitPrice = $price_list->price;
                        if($discount_type[$i] == 'Percentage')
                        {                            
                            $quotationItem->LineDiscPrcnt = $disc_perct[$i];
                            $quotationItem->PerSqftDisc = round($price_list->price*($disc_perct[$i]/100)/$item->sqft_Conv,2);  
                            $quotationItem->LineDiscPrice = round($LineDiscPrice[$i]*100/($item->taxRate+100),2); 
                            $quotationItem->PriceAfterDisc = round(($price_list->price - $price_list->price * $disc_perct[$i]/100) * $quantity[$i],2);
                        }                           
                        
                        else
                        {
                            $quotationItem->PerSqftDisc = round($disc_perct[$i]*100/($item->taxRate+100),2);  
                            $quotationItem->LineDiscPrice = round($LineDiscPrice[$i]*100/($item->taxRate+100),2);                      
                            $quotationItem->PriceAfterDisc = round($price_list->price * $quantity[$i] - $quotationItem->LineDiscPrice,2); 
                        }

                        if($item->taxRate)
                            $taxRate = $quotationItem->TaxRate = $item->taxRate;
                        $quotationItem->TaxAmount = round($quotationItem->PriceAfterDisc * $item->taxRate/100,2);
                        $quotationItem->LineTotal = round($quotationItem->PriceAfterDisc,2);
                        $quotationItem->PriceAfterDisc = round($quotationItem->PriceAfterDisc/$quantity[$i],2);
                        $quotationItem->LineNo = $lineNo;
                        $quotationItem->LineTotal = round($LineTotal[$i] * 100/($item->taxRate+100),2);
                        $grand_total = $grand_total + $quotationItem->LineTotal;
                        $quotationItem->save();
                        $lineNo++;
                    }
                }
            }
        }
        if(!empty($taxRate))
            $quotation->DiscAmount = round($request->discount_amount*100/($taxRate+100),2);        
        else
            $quotation->DiscAmount = round($request->discount_amount,2);
        /*if(!empty($grandTotal) && !empty($taxRate))
        {
            $quotation->DocTotal = round($grandTotal * 100/($taxRate+100),2);
        }
        else
        {*/
            $DocTotal = $grand_total+$quotation->FreightCharge+$quotation->LoadingCharge+$quotation->UnloadingCharge;
            $quotation->DocTotal = round($DocTotal,2);
        //}
        $quotation->save();
        return redirect('admin/quotations/'.$quotation_id)->with('success','Quotation added successfully');
    }
}
