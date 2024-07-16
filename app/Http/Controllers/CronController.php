<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryAttribute;
use App\Models\Warehouse;
use App\Models\ProductStock;
use App\Models\ProductPrice;
use Redirect;

class CronController extends Controller
{
    public function product()
    {
        //$dateP = Product::orderBy('updated_date','desc')->first();

        $last_up = date('d/m/Y');//date('d/m/Y',strtotime($dateP->updated_date));

        $url = 'http://178.33.58.18:5002/MG/ProductMaster';

        // Create a new cURL resource
        $ch = curl_init($url);

        // Setup request to send json via POST
        $payload = '{"UpdateDate":'.$last_up.'}';
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
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
        $result = curl_exec($ch); //exit;

        // Close cURL resource
        curl_close($ch);
        $products = json_decode($result);
        if(count($products) > 0)
        {
            //Product::truncate();
            foreach ($products as $key => $value) 
            {
                //echo "kkk".$value->updateDate."pppp".date('Y-m-d H:i:s',strtotime($value->updateDate)); exit;
                $product = Product::where('productCode',$value->productCode)->first();
                if(empty($product))
                {
                    $product = new Product;

                    $ProductPrice = ProductPrice::where('productCode',$value->productCode)->first();
                    if(empty($ProductPrice))
                    {
                        $ProductPrice = new ProductPrice;
                        $ProductPrice->productCode = $value->productCode;
                        $ProductPrice->save();
                    }
                    
                    $ProductStock = ProductStock::where('productCode',$value->productCode)->first();
                    if(empty($ProductStock))
                    {
                        $ProductStock = new ProductStock;
                        $ProductStock->productCode = $value->productCode;
                        $ProductStock->save();
                    }                    
                    
                }
                $product->productCode = $value->productCode;
                $product->productName = $value->productName;
                $product->barcode = $value->barcode;
                $product->invUOM = $value->invUOM;
                $product->saleUOM = $value->saleUOM;
                $product->hsnCode = $value->hsnCode;
                $product->taxRate = $value->taxRate;
                $product->categoryCode = $value->categoryCode;
                $product->subCateg = $value->subCateg;
                $product->type = $value->type;
                $product->brand = $value->brand;
                $product->size = $value->size;
                $product->color = $value->color;
                $product->finish = $value->finish;
                $product->thickness = $value->thickness;
                $product->conv_Factor = $value->conv_Factor;
                $product->sqft_Conv = $value->sqft_Conv;
                $product->boxQty = $value->boxQty;
                $product->weight = $value->weight;
                $product->image = $value->imagePath;
                $product->is_active = $value->active;
                $product->updated_date = date("Y-m-d", strtotime(str_replace('/', '-', $value->updateDate)));
                
                $product->save();
            }
        }
        return Redirect::back()->with('success','Product master updated successfully');
    }
    public function category()
    {
        $url = 'http://178.33.58.18:5002/MG/Category?updateDate=""';

        // Create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        // Set the content type to application/json
        $headers = array(
            "Authorization: Bearer eyJhbGciOiJSUzI1NiIsImtpZCI6IjEzRjhFREM2QjJCNTU3OUQ0MEVGNDg1QkNBOUNFRDBBIiwidHlwIjoiYXQrand0In0.eyJuYmYiOjE2OTgwNDM3MDQsImV4cCI6MTcyOTU3OTcwNCwiaXNzIjoiaHR0cDovL2xvY2FsaG9zdDo1MDAwIiwiYXVkIjoiQ3VzdG9tZXJTZXJ2aWNlLkFwaSIsImNsaWVudF9pZCI6Im5hc19jbGllbnQiLCJzdWIiOiJkMWU0YjcyYi0zNmZkLTQ0YTItYTJkNy1iZmE4ODhiNGE4Y2QiLCJhdXRoX3RpbWUiOjE2OTgwNDM3MDMsImlkcCI6ImxvY2FsIiwic2VydmljZS51c2VyIjoiYWRtaW4iLCJqdGkiOiI3RTkwNTNGRjU3RUFDNzQ1QzZGMDY2N0IwMjQ4OTE4NCIsInNpZCI6IjFCRkIyRTYwNjkzRUE4OUMwQjVDQ0M2MkJDNEExMjIwIiwiaWF0IjoxNjk4MDQzNzA0LCJzY29wZSI6WyJvcGVuaWQiLCJwcm9maWxlIiwibmFzLmNsaWVudCIsIm5hcy5zZXJ2aWNlcyJdLCJhbXIiOlsicHdkIl19.c7luIjRCKOaDauPUOf8_2rBRn3oRczJkh0gN-CLrI3Gk83JQjZ8nuW1Cuzj6Y4nmc6n8_LvKFvqm9vj0Os-IdhAUGjyIaUQkNe64npARCm6qloUY8KBWBqWj3-sSVGkeR395zmBTAz4ppVqxjR2Symy-9C061kKzF13NCWWFrbwwfmFEubejgEVxoD9KE-_38KMruhLDTfE1MxFRuMnoqPF2LuPxTBruJp57zYdgxCmLdn47GvRXdumXzxiRD6XqPByyT95FwCZzuoN_Cfk_W3ZGKVi6ivBmzP2Ktb_gJoUCN4uayXACDGjoc3FaokDCwmrfE6rYXb_L24gnTVzR3g",
            "Content-Type: application/json",
         );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the POST request
        echo $result = curl_exec($ch);

        // Close cURL resource
        curl_close($ch);
        $categories = json_decode($result);
        foreach ($categories as $key => $value) 
        {
            $category = Category::where('categoryCode',$value->categoryCode)->first();
            if(empty($category))
            {
                $category = new Category;
            }
            $category->categoryCode = $value->categoryCode;
            $category->categoryName = $value->categoryName;

            $category->save();
        }
    }
    public function categoryAttribute()
    {
        $url = 'http://178.33.58.18:5002/MG/CategoryAttributes';

        // Create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        // Set the content type to application/json
        $headers = array(
            "Authorization: Bearer eyJhbGciOiJSUzI1NiIsImtpZCI6IjEzRjhFREM2QjJCNTU3OUQ0MEVGNDg1QkNBOUNFRDBBIiwidHlwIjoiYXQrand0In0.eyJuYmYiOjE2OTgwNDM3MDQsImV4cCI6MTcyOTU3OTcwNCwiaXNzIjoiaHR0cDovL2xvY2FsaG9zdDo1MDAwIiwiYXVkIjoiQ3VzdG9tZXJTZXJ2aWNlLkFwaSIsImNsaWVudF9pZCI6Im5hc19jbGllbnQiLCJzdWIiOiJkMWU0YjcyYi0zNmZkLTQ0YTItYTJkNy1iZmE4ODhiNGE4Y2QiLCJhdXRoX3RpbWUiOjE2OTgwNDM3MDMsImlkcCI6ImxvY2FsIiwic2VydmljZS51c2VyIjoiYWRtaW4iLCJqdGkiOiI3RTkwNTNGRjU3RUFDNzQ1QzZGMDY2N0IwMjQ4OTE4NCIsInNpZCI6IjFCRkIyRTYwNjkzRUE4OUMwQjVDQ0M2MkJDNEExMjIwIiwiaWF0IjoxNjk4MDQzNzA0LCJzY29wZSI6WyJvcGVuaWQiLCJwcm9maWxlIiwibmFzLmNsaWVudCIsIm5hcy5zZXJ2aWNlcyJdLCJhbXIiOlsicHdkIl19.c7luIjRCKOaDauPUOf8_2rBRn3oRczJkh0gN-CLrI3Gk83JQjZ8nuW1Cuzj6Y4nmc6n8_LvKFvqm9vj0Os-IdhAUGjyIaUQkNe64npARCm6qloUY8KBWBqWj3-sSVGkeR395zmBTAz4ppVqxjR2Symy-9C061kKzF13NCWWFrbwwfmFEubejgEVxoD9KE-_38KMruhLDTfE1MxFRuMnoqPF2LuPxTBruJp57zYdgxCmLdn47GvRXdumXzxiRD6XqPByyT95FwCZzuoN_Cfk_W3ZGKVi6ivBmzP2Ktb_gJoUCN4uayXACDGjoc3FaokDCwmrfE6rYXb_L24gnTVzR3g",
            "Content-Type: application/json",
         );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the POST request
        echo $result = curl_exec($ch);

        // Close cURL resource
        curl_close($ch);
        $categories = json_decode($result);
        foreach ($categories as $key => $value) 
        {
            $category = CategoryAttribute::where('categoryCode',$value->categoryCode)->where('subCateg',$value->subCateg)->first();
            if(empty($category))
            {
                $category = new CategoryAttribute;
            }
            $category->categoryCode = $value->categoryCode;
            $category->subCateg = $value->subCateg;
            $category->type = $value->type;
            $category->brand = $value->brand;
            $category->size = $value->size;
            $category->color = $value->color;
            $category->finish = $value->finish;
            $category->thickness = $value->thickness;
                
            $category->save();
        }
    }

    public function warehouse()
    {
        phpinfo();exit;
        $url = 'http://178.33.58.18:5002/MG/Warehouse?UpdateDate=""';

        // Create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        // Set the content type to application/json
        $headers = array(
            "Authorization: Bearer eyJhbGciOiJSUzI1NiIsImtpZCI6IjEzRjhFREM2QjJCNTU3OUQ0MEVGNDg1QkNBOUNFRDBBIiwidHlwIjoiYXQrand0In0.eyJuYmYiOjE2OTgwNDM3MDQsImV4cCI6MTcyOTU3OTcwNCwiaXNzIjoiaHR0cDovL2xvY2FsaG9zdDo1MDAwIiwiYXVkIjoiQ3VzdG9tZXJTZXJ2aWNlLkFwaSIsImNsaWVudF9pZCI6Im5hc19jbGllbnQiLCJzdWIiOiJkMWU0YjcyYi0zNmZkLTQ0YTItYTJkNy1iZmE4ODhiNGE4Y2QiLCJhdXRoX3RpbWUiOjE2OTgwNDM3MDMsImlkcCI6ImxvY2FsIiwic2VydmljZS51c2VyIjoiYWRtaW4iLCJqdGkiOiI3RTkwNTNGRjU3RUFDNzQ1QzZGMDY2N0IwMjQ4OTE4NCIsInNpZCI6IjFCRkIyRTYwNjkzRUE4OUMwQjVDQ0M2MkJDNEExMjIwIiwiaWF0IjoxNjk4MDQzNzA0LCJzY29wZSI6WyJvcGVuaWQiLCJwcm9maWxlIiwibmFzLmNsaWVudCIsIm5hcy5zZXJ2aWNlcyJdLCJhbXIiOlsicHdkIl19.c7luIjRCKOaDauPUOf8_2rBRn3oRczJkh0gN-CLrI3Gk83JQjZ8nuW1Cuzj6Y4nmc6n8_LvKFvqm9vj0Os-IdhAUGjyIaUQkNe64npARCm6qloUY8KBWBqWj3-sSVGkeR395zmBTAz4ppVqxjR2Symy-9C061kKzF13NCWWFrbwwfmFEubejgEVxoD9KE-_38KMruhLDTfE1MxFRuMnoqPF2LuPxTBruJp57zYdgxCmLdn47GvRXdumXzxiRD6XqPByyT95FwCZzuoN_Cfk_W3ZGKVi6ivBmzP2Ktb_gJoUCN4uayXACDGjoc3FaokDCwmrfE6rYXb_L24gnTVzR3g",
            "Content-Type: application/json",
         );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the POST request
        echo $result = curl_exec($ch);

        // Close cURL resource
        curl_close($ch);
        $Warehouses = json_decode($result);
        foreach ($Warehouses as $key => $value) 
        {
            $Warehouse = Warehouse::where('whsCode',$value->whsCode)->first();
            if(empty($Warehouse))
            {
                $Warehouse = new Warehouse;
            }
            
            $Warehouse->whsCode = $value->whsCode;
            $Warehouse->whsName = $value->whsName;
            $Warehouse->save();
        }
    }

    public function prodStock()
    {
        //$dateP = ProductStock::orderBy('updated_date','desc')->first();

        $last_up = date('d/m/Y');//date('d/m/Y',strtotime($dateP->updated_date));

        $url = 'http://178.33.58.18:5002/MG/ProdStock';

        // Create a new cURL resource
        $ch = curl_init($url);
        $payload = '{"UpdateDate":"'.$last_up.'"}';
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
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

        // Close cURL resource
        curl_close($ch);
        $stocks = json_decode($result);
        if(count($stocks) > 0)
        {
            //ProductStock::truncate();
            foreach ($stocks as $key => $value) 
            {
                $ProductStock = ProductStock::where('whsCode',$value->whsCode)->where('productCode',$value->productCode)->first();
                if(empty($ProductStock))
                {
                    $ProductStock = new ProductStock;
                }
                
                $ProductStock->whsCode = $value->whsCode;
                $ProductStock->productCode = $value->productCode;
                $ProductStock->onHand = $value->onHand;
                $ProductStock->blockQty = $value->blockQty;
                $ProductStock->updated_date = date("Y-m-d", strtotime(str_replace('/', '-', $value->updateDate)));
                $ProductStock->save();
            }
        }
        return Redirect::back()->with('success','Stock updated successfully');
    }

    public function prodPrice()
    {
        //$dateP = ProductPrice::orderBy('updated_date','desc')->first();

        $last_up = date('d/m/Y');//date('d/m/Y',strtotime($dateP->updated_date));

        $url = 'http://178.33.58.18:5002/MG/ProdPrice';

        // Create a new cURL resource
        $ch = curl_init($url);
        $payload = '{"UpdateDate":"'.$last_up.'"}';
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
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
        $result = curl_exec($ch); //exit;

        // Close cURL resource
        curl_close($ch);
        $ProductPrices = json_decode($result);
        if(count($ProductPrices) > 0)
        {
            //ProductPrice::truncate();
            foreach ($ProductPrices as $key => $value) 
            {
                $ProductPrice = ProductPrice::where('productCode',$value->productCode)->where('priceList',$value->priceList)->first();
                if(empty($ProductPrice))
                {
                    $ProductPrice = new ProductPrice;
                }
                
                $ProductPrice->productCode = $value->productCode;
                $ProductPrice->priceList = $value->priceList;
                $ProductPrice->price = $value->price;
                $ProductPrice->updated_date = date("Y-m-d", strtotime(str_replace('/', '-', $value->updateDate)));
                $ProductPrice->save();
            }
        }
        return Redirect::back()->with('success','Price updated successfully');
    }
}
