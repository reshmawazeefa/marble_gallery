<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Partner;
use App\Models\Quotation;
use App\Models\CustomQuotation;
use Illuminate\Http\Request;
use DataTables;
use Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*$customers = Customer::get();
        return view('admin.customers', compact('customers'));*/
        if ($request->ajax()) {
            //\DB::enableQueryLog(); // Enable query log
            $data = Customer::select('*');
            //dd(\DB::getQueryLog()); // Show results of log
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $url_edit = url('admin/customers/'.$row->id.'/edit');
                    if($row->is_active == 1)
                        $checked = "checked";

                    else
                        $checked = "";
                    $t = csrf_token();
                    $actionBtn = '<input data-token='.$t.' data-id='.$row->id.' class="checkActive" '.$checked.' type="checkbox">&nbsp;&nbsp;<a href='.$url_edit.' class="btn btn-info"><i class="mdi mdi-square-edit-outline"></i>Edit</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.customers');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add_customer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {         
        $last = Customer::where('added_from', 'pos')->orderBy('id','desc')->first();
        $array = array();
        if($last)
        {
            $code = $last->customer_code;
            $array = explode('CU',$code);
        }
        if(count($array) > 1)
            $num = $array[1]+1;            
        else
            $num = 1;
        /*if(strlen($num) < 7)
                $num = str_pad($num, 7, '0', STR_PAD_LEFT);*/
        if($request->ajax())
        {
            $validator = Validator::make(
                $request->all(), ['name' => 'max:50',
                'phone' => 'numeric|unique:customers,phone|min:10|digits:10', 
                'alt_phone' => 'numeric|min:10|digits:10', 
                'email' => 'nullable|unique:customers,email|max:50', 
                'addressID' => 'max:45', 
                'address' => 'max:50', 
                'address2' => 'max:50', 
                'place' => 'max:50',
                'zip_code' => 'max:15', 
                'state' => 'max:50', 
                'country' => 'max:50',
                'addressIDBilling' => 'max:45', 
                'addressBilling' => 'max:50', 
                'address2Billing' => 'max:50', 
                'placeBilling' => 'max:50',
                'zip_codeBilling' => 'max:15', 
                'stateBilling' => 'max:50', 
                'countryBilling' => 'max:50',
                'gstin' => 'max:100']);

            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()->all()]);
            }
        }
        else{        
            $validator = $request->validate( ['name' => 'required|max:50', 
                'phone' => 'required|numeric|unique:customers,phone|digits:10', 
                'alt_phone' => 'numeric|digits:10', 
                'email' => 'nullable|unique:customers,email|max:50', 
                'addressID' => 'required|max:50', 
                'address' => 'required|max:50', 
                'address2' => 'required|max:50', 
                'place' => 'max:50',
                'zip_code' => 'required|max:15', 
                'state' => 'max:100', 
                'addressIDBilling' => 'required|max:50', 
                'addressBilling' => 'required|max:50', 
                'address2Billing' => 'required|max:50', 
                'placeBilling' => 'max:50',
                'zip_codeBilling' => 'required|max:15', 
                'stateBilling' => 'max:50',
                'gstin' => 'max:100']);          
        }

        $Customer= new Customer();
        $Customer->name= $request->name;
        //$Customer->customer_code= $request->customer_code;
        $Customer->customer_code= 'CU'.$num;
        $Customer->phone= $request->phone;
        $Customer->alt_phone= $request->alt_phone;
        $Customer->email= $request->email;            
        $Customer->addressID= $request->prefix.' '.$request->addressID;            
        $Customer->address= $request->address;            
        $Customer->address2= $request->address2;  
        $Customer->place= $request->place;
        $Customer->zip_code= $request->zip_code;
        $Customer->state= $request->state;
        $Customer->country= $request->country;       
        $Customer->addressIDBilling= $request->prefixBilling.' '.$request->addressIDBilling;            
        $Customer->addressBilling= $request->addressBilling;            
        $Customer->address2Billing= $request->address2Billing;  
        $Customer->placeBilling= $request->placeBilling;
        $Customer->zip_codeBilling= $request->zip_codeBilling;
        $Customer->stateBilling= $request->stateBilling;
        $Customer->countryBilling= $request->countryBilling;
        $Customer->description= $request->description;
        $Customer->gstin = $request->gstin;
        $Customer->save();

        $url = 'http://178.33.58.18:5002/MG/Customer';

        $cust = array("CustomerCode" => $Customer->customer_code,
        "CustomerName" => $Customer->name,            
        "ContactNumber" => $Customer->phone,            
        "EMail" => $Customer->email,                
            "ContactNumber" => $Customer->phone,              
            "AltContactNumber" => $Customer->alt_phone,            
            "EMail" => $Customer->email,      
            "Place" => $Customer->place,  
            "AddressID" => $Customer->addressID,             
            "Address" => $Customer->address,                 
            "Address2" => $Customer->address2,                
            "ZipCode" => $Customer->zip_code,            
            "State" => $Customer->state,       
            "Country" => $Customer->country,    
            "AddressIDBilling" => $Customer->addressIDBilling,             
            "AddressBilling" => $Customer->addressBilling,                 
            "Address2Billing" => $Customer->address2Billing, 
            "PlaceBilling" => $Customer->placeBilling,                 
            "ZipCodeBilling" => $Customer->zip_codeBilling,            
            "StateBilling" => $Customer->stateBilling,       
            "CountryBilling" => $Customer->countryBilling,     
            "Description" => $Customer->description,            
            "GSTIN" => $Customer->gstin,
        );

        // Create a new cURL resource
        $ch = curl_init($url);

        // Setup request to send json via POST
        $payload = json_encode($cust);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        // Attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        // Set the content type to application/json
        $headers = array(
            "Authorization: Bearer eyJhbGciOiJSUzI1NiIsImtpZCI6IjEzRjhFREM2QjJCNTU3OUQ0MEVGNDg1QkNBOUNFRDBBIiwidHlwIjoiYXQrand0In0.eyJuYmYiOjE2OTgwNDM3MDQsImV4cCI6MTcyOTU3OTcwNCwiaXNzIjoiaHR0cDovL2xvY2FsaG9zdDo1MDAwIiwiYXVkIjoiQ3VzdG9tZXJTZXJ2aWNlLkFwaSIsImNsaWVudF9pZCI6Im5hc19jbGllbnQiLCJzdWIiOiJkMWU0YjcyYi0zNmZkLTQ0YTItYTJkNy1iZmE4ODhiNGE4Y2QiLCJhdXRoX3RpbWUiOjE2OTgwNDM3MDMsImlkcCI6ImxvY2FsIiwic2VydmljZS51c2VyIjoiYWRtaW4iLCJqdGkiOiI3RTkwNTNGRjU3RUFDNzQ1QzZGMDY2N0IwMjQ4OTE4NCIsInNpZCI6IjFCRkIyRTYwNjkzRUE4OUMwQjVDQ0M2MkJDNEExMjIwIiwiaWF0IjoxNjk4MDQzNzA0LCJzY29wZSI6WyJvcGVuaWQiLCJwcm9maWxlIiwibmFzLmNsaWVudCIsIm5hcy5zZXJ2aWNlcyJdLCJhbXIiOlsicHdkIl19.c7luIjRCKOaDauPUOf8_2rBRn3oRczJkh0gN-CLrI3Gk83JQjZ8nuW1Cuzj6Y4nmc6n8_LvKFvqm9vj0Os-IdhAUGjyIaUQkNe64npARCm6qloUY8KBWBqWj3-sSVGkeR395zmBTAz4ppVqxjR2Symy-9C061kKzF13NCWWFrbwwfmFEubejgEVxoD9KE-_38KMruhLDTfE1MxFRuMnoqPF2LuPxTBruJp57zYdgxCmLdn47GvRXdumXzxiRD6XqPByyT95FwCZzuoN_Cfk_W3ZGKVi6ivBmzP2Ktb_gJoUCN4uayXACDGjoc3FaokDCwmrfE6rYXb_L24gnTVzR3g",
            "Content-Type: application/json",
         );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the POST request
        $result = curl_exec($ch);

        $res = json_decode($result);

        curl_close($ch);

        if($request->ajax())
        {
            return response()->json(['success'=>'Added new records.']);
        }
        else
        {
            return redirect('admin/customers')->with('success','Customer added successfully');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        echo "ssss";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('admin.edit_customer', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $validator = $request->validate(['name' => 'required|max:50', 
        'customer_code' => 'required|unique:customers,customer_code,'.$customer->id, 
        'phone' => 'required|numeric|digits:10', //unique:customers,phone,'.$customer->id.'|
        'alt_phone' => 'nullable|digits:10', 
        'email' => 'nullable|max:100',  //|unique:customers,email,'.$customer->id.'
        'addressID' => 'required|max:45', 
        'address' => 'required|max:70', 
        'address2' => 'required|max:70',
        'place' => 'max:255',
        'zip_code' => 'required|max:15', 
        'state' => 'max:100', 
        'country' => 'max:100',
        'addressIDBilling' => 'required|max:45', 
        'addressBilling' => 'required|max:70', 
        'address2Billing' => 'required|max:70', 
        'placeBilling' => 'max:255',
        'zip_codeBilling' => 'required|max:15', 
        'stateBilling' => 'max:100',
        'gstin' => 'max:100' 
        ]);

        //$validator->description = $request->description;

        $Customer = Customer::where('id', $customer->id)->first();
        $Customer->name= $request->name;
        //$Customer->customer_code= $request->customer_code;
        $Customer->phone= $request->phone;
        $Customer->alt_phone= $request->alt_phone;
        $Customer->email= $request->email;                 
        $Customer->addressID= $request->prefix.' '.$request->addressID;            
        $Customer->address= $request->address;            
        $Customer->address2= $request->address2; 
        $Customer->place= $request->place;
        $Customer->zip_code= $request->zip_code;
        $Customer->state= $request->state;
        $Customer->country= $request->country;
        $Customer->addressIDBilling= $request->prefixBilling.' '.$request->addressIDBilling;            
        $Customer->addressBilling= $request->addressBilling;            
        $Customer->address2Billing= $request->address2Billing;  
        $Customer->placeBilling= $request->placeBilling;
        $Customer->zip_codeBilling= $request->zip_codeBilling;
        $Customer->stateBilling= $request->stateBilling;
        $Customer->countryBilling= $request->countryBilling;
        $Customer->description= $request->description;
        $Customer->gstin = $request->gstin;
        $Customer->save();

        return redirect('admin/customers')->with('success','Customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return 1;
    }

    public function generateBarcodeNumber(Request $request) {
        $type = $request->type;
        if ($type == 'partner') 
        {
            $partner = Partner::orderBy('id','desc')->first();
            $array = array();
            if($partner)
            {
                $code = $partner->partner_code;
                $array = explode('PA',$code);
            }
            if(count($array) > 1)
                $num = $array[1]+1;            
            else
                $num = 1;
            /*if(strlen($num) < 7)
                $num = str_pad($num, 7, '0', STR_PAD_LEFT);*/
            return 'PA'.$num;
        }
        elseif($type == 'customer')
        {
            $customer = Customer::where('added_from', 'pos')->orderBy('id','desc')->first();
            $array = array();
            if($customer)
            {
                $code = $customer->customer_code;
                $array = explode('CU',$code);
            }
            if(count($array) > 1)
                $num = $array[1]+1;            
            else
                $num = 1;

            /*if(strlen($num) < 7)
                $num = str_pad($num, 7, '0', STR_PAD_LEFT);*/
            return 'CU'.$num;
        }
        else
        {
            $lastQuotation = Quotation::orderBy('id','desc')->first();
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
            return $num;
        }
    }
    public function status(Request $request)
    {
        $id = $request->id;
        $Customer = Customer::find($id);
        $Customer->is_active = $request->is_active;
        $Customer->save();
    }
}
