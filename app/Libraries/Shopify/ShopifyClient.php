<?php

namespace App\Libraries\Shopify;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ShopifyClient{

  private $accessToken;
  private $shopifyDomain;
  private $version;
  private $url;
  public function __construct($store){

    $this->accessToken = $store->source_auth->api_key; // Access token
    $this->shopifyDomain = $store->source_auth->api_url; // DOMAIN
    $this->version = $store->source_auth->DynamicFields->where('field_name', 'shopifyapiversion')->first()->field_value; // API version
    
    $this->url = 'https://'.$this->shopifyDomain.'/admin/api/'.$this->version.'/graphql.json';

  }

  public function checkOrderQuantityRemoved($OrderID){
    $query = '{
      order(id:"'.$OrderID.'"){
        edited
        lineItems(first:10){
          edges{
            node{
              currentQuantity
              quantity
            }
          }
        }
      }
    }';

    $response = Http::withHeaders([
      'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);
    if(isset($response->json()['errors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['errors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['order'];
    }

    return $return;
  }

  public function isOrderCancelled($OrderID){
    $query = '{
      order(id:"'.$OrderID.'"){
        cancelledAt
      }
    }';

    $response = Http::withHeaders([
      'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);
    if(isset($response->json()['errors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['errors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['order'];
    }
    return $return;
  }
  public function getOrders($filterOptions, $forlist = false, &$response = []){

      $ordersfrom = 'first';

      if($filterOptions['cursor_position'] == 'before'){
          $ordersfrom = 'last';
      }

      if(empty($filterOptions['current_page_no'])){

          $variables = [
              'pageSize' => $filterOptions['rows_per_page']
          ];

      } else {

          $variables = [
              'pageSize' => $filterOptions['rows_per_page'],
              'cursor' => $filterOptions['current_page_no'],
          ];

      }

      if(!empty($filterOptions['order_number'])){
        $variables['querystring'] = "name:".$filterOptions['order_number'];
      }

      if(!empty($filterOptions['created_at'])){

        if(isset($variables['querystring']) && !empty($variables['querystring'])){
          $variables['querystring'] .= " AND created_at:>=".$filterOptions['created_at'];
        } else {
          $variables['querystring'] = "created_at:>=".$filterOptions['created_at'];
        }
      }

      if(!empty($filterOptions['last_run'])){
        if(isset($variables['querystring']) && !empty($variables['querystring'])){
          $variables['querystring'] .= " AND updated_at:>=".$filterOptions['last_run'];
        } else {
          $variables['querystring'] = "updated_at:>=".$filterOptions['last_run'];
        }
      }
      
      if(isset($filterOptions['shopify_order_transfer_payment_status']) && !empty($filterOptions['shopify_order_transfer_payment_status'])){
        if(isset($variables['querystring']) && !empty($variables['querystring'])){
          $variables['querystring'] .= " AND financial_status:".$filterOptions['shopify_order_transfer_payment_status'];
        } else {
          $variables['querystring'] = "financial_status:".$filterOptions['shopify_order_transfer_payment_status'];
        }
      }
      
      if(isset($filterOptions['shopify_order_transfer_fulfillment_status']) && !empty($filterOptions['shopify_order_transfer_fulfillment_status'])){
        if(isset($variables['querystring']) && !empty($variables['querystring'])){
          $variables['querystring'] .= " AND fulfillment_status:".$filterOptions['shopify_order_transfer_fulfillment_status'];
        } else {
          $variables['querystring'] = "fulfillment_status:".$filterOptions['shopify_order_transfer_fulfillment_status'];
        }
      }


      $query = '
          query ($pageSize: Int!, $cursor: String, $querystring: String) {
              orders('.$ordersfrom.': $pageSize, '.$filterOptions['cursor_position'].': $cursor, query:$querystring, sortKey:CREATED_AT, reverse:true) {
                  pageInfo {
                      hasNextPage
                      hasPreviousPage
                  }
                  edges {
                      node {
                          id
                          name
                          createdAt
                          updatedAt
                          totalPrice
                          displayFinancialStatus
                          displayFulfillmentStatus
                          currencyCode
                          customer{
                              displayName
                          }
                      }
                      cursor
                  }
              }
      }';
      $apiResponse = Http::withHeaders([
        'X-Shopify-Access-Token' => $this->accessToken,
      ])->post($this->url, [
          'query' => $query,
          'variables' => $variables,
      ]);

      $jsonResponse = $apiResponse->json();

      if (isset($jsonResponse['errors'])) {
          return [
              'error' => true,
              'messages' => $jsonResponse['errors'],
          ];
      }

      $orderData = $jsonResponse['data']['orders'] ?? [];

      if ($forlist && ($orderData['pageInfo']['hasNextPage'] ?? false)) {
          $nextCursor = end($orderData['edges'])['cursor'] ?? null;
          if ($nextCursor) {

              $filterOptions['current_page_no'] = $nextCursor;

              $this->getOrders($filterOptions, $forlist, $response);
          }
      }

      $response = array_merge($response, $orderData['edges'] ?? []);
      // dd($response);
      return [
          'error' => false,
          'response' => $response,
      ];
  }


  public function getOrder($OrderID){

      $query = '
		{
			order(id: "gid://shopify/Order/'.$OrderID.'") {
				id
				name
				createdAt
				updatedAt
                
				shippingLine{
					carrierIdentifier
					code
					title
					discountedPriceSet{
						presentmentMoney{
							amount
							currencyCode
						}
					}
				}
				subtotalPriceSet{
					presentmentMoney{
						amount
						currencyCode
					}
				}
				totalPriceSet{
					presentmentMoney{
						amount
						currencyCode
					}
				}
				totalRefundedSet{
					presentmentMoney{
						amount
						currencyCode
					}
				}
				netPaymentSet{
					presentmentMoney{
						amount
						currencyCode
					}
				}
				displayFinancialStatus
				displayFulfillmentStatus
				currencyCode
				customer{
					displayName
					email
				}
				billingAddress{
					name
					address1
					address2
					city
					zip
					country
					phone
					province
					provinceCode
				}
				shippingAddress{
					name
					address1
					address2
					city
					zip
					phone
					country
					province
					provinceCode
				}
				lineItems(first:250){
					edges{
						node{
							id
							title
							quantity
							sku
							customAttributes{
								key
								value
							}
							originalUnitPriceSet{
								presentmentMoney{
									amount
									currencyCode
								}
							}
							discountedUnitPriceSet{
								presentmentMoney{
									amount
									currencyCode
								}
							}
						}
						cursor
					}
				}
			}
          }';
      $response = Http::withHeaders([
          'X-Shopify-Access-Token' =>  $this->accessToken,
      ])->post($this->url, [
          'query' => $query
      ]);
      if(isset($response->json()['errors'])){
          $return['error'] = true;
          $return['response'] = $response->json()['errors'];
      }else{
          $return['error'] = false;
          $return['response'] = $response->json()['data']['order'];
      }
      return $return;
  }

  public function getOrderBySku($sku){

    $query = '
    {
      orders(first:250, query:"sku:'.$sku.'"){
        edges{
          node{
            id
            lineItems(first:200){
              edges{
                node{
                  sku
                  product{
                    id
                  }
                }
              }
            }
          }
        }
      }
    }';
    $response = Http::withHeaders([
        'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);

    if(isset($response->json()['errors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['errors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['orders'];
    }
    return $return;
  }

  public function getPublications(){
    $query ='{
      publications(first:10){
        edges{
          node{
            id
            autoPublish
            
          }
        }
      }
    }';
    $response = Http::withHeaders([
        'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);

    if(isset($response->json()['errors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['errors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['publications'];
    }
    return $return;
  }
  public function getOrderByName($name){
      $query = '
      {
          orders(query:"name:'.$name.'" first:1) {
            edges{
              node{
                id
                name
              }
            }
          }
      }';
      $response = Http::withHeaders([
          'X-Shopify-Access-Token' =>  $this->accessToken,
      ])->post($this->url, [
          'query' => $query
      ]);
      //dd($response->json());
      if(isset($response->json()['errors'])){
          $return['error'] = true;
          $return['response'] = $response->json()['errors'];
      }else{
          $return['error'] = false;
          $return['response'] = $response->json()['data']['orders'];
      }
      return $return;
  }

  public function FilterOrders(){
    $query = '
    {
      orders(query:"created_at:>=2024-06-11 AND fulfillment_status:shipped AND financial_status:authorized OR financial_status:partially_paid AND delivery_status:tracking_added", first:100){
        edges{
          node{
            name
            id
            displayFinancialStatus
            fulfillments(first:10){
              id
              trackingInfo{
                customer
                number
              }
            }
          }
        }
      }
    }';
    $response = Http::withHeaders([
        'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);
    //dd($response->json());
    if(isset($response->json()['errors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['errors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['orders'];
    }
    return $return;
  }

  public function getProductVariantBySku($sku){
    $query = '
    {
      productVariants(query:"'.$sku.'" first:10){
        edges{
          node{
            sku
            id
            product{
              id
            }
            inventoryItem{
              id
            }
          }
        }
      }
    }';
    $response = Http::withHeaders([
        'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);

    //dd($response->json());

    if(isset($response->json()['errors'])){

      $return['error'] = true;
      $return['response'] = $response->json()['errors'];

    } else {
      
      $return['error'] = false;
      $return['response'] = $response->json()['data']['productVariants'];

    }

    return $return;

  }

  public function getProductVariantBySkus($skus){
    $query = '
    {
      productVariants(query:"'.$skus.'" first:250){
        edges{
          node{
            sku
            id
            product{
              id
            }
            inventoryItem{
              id
              inventoryLevels(first:50){
              edges{
                node{
                  quantities(names:["available","on_hand"]){
                    name
                    quantity
                  }
                  location{
                    id
                    metafield(namespace:"custom", key:"store_id"){
                      value
                    }
                  }
                }
              }
            }
            }
          }
        }
      }
    }';
    $response = Http::withHeaders([
        'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);

    //dd($response->json());

    if(isset($response->json()['errors'])){

      $return['error'] = true;
      $return['response'] = $response->json()['errors'];

    } else {
      
      $return['error'] = false;
      $return['response'] = $response->json()['data']['productVariants'];

    }

    return $return;

  }

  public function getProductVariantinventoriesBySkus($skus){
    $query = '
    {
      productVariants(query:"'.$skus.'" first:250){
        edges{
          node{
            sku
            id
            product{
              id
            }
            inventoryItem{
              id
            }
          }
        }
      }
    }';
    $response = Http::withHeaders([
        'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);

    //dd($response->json());

    if(isset($response->json()['errors'])){

      $return['error'] = true;
      $return['response'] = $response->json()['errors'];

    } else {
      
      $return['error'] = false;
      $return['response'] = $response->json()['data']['productVariants'];

    }

    return $return;

  }

  public function getProductBySku($sku){
    $query = '
    {
      products(query:"'.$sku.'" first:10){
        edges{
          node{
           	id
          }
        }
      }
    }';
    $response = Http::withHeaders([
        'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);

    //dd($response->json());

    if(isset($response->json()['errors'])){

      $return['error'] = true;
      $return['response'] = $response->json()['errors'];

    } else {
      
      $return['error'] = false;
      $return['response'] = $response->json()['data']['products'];

    }

    return $return;

  }
  public function getOrderReturnByID($ReturnID){
      $query ='
      {
          return(id:"'.$ReturnID.'"){
              returnLineItems(first:100){
                  pageInfo{
                      hasNextPage
                      startCursor
                  }
                  edges{
                      node{
                      fulfillmentLineItem{
                          lineItem{
                          id
                          }
                      }
                      quantity
                      returnReason
                      returnReasonNote
                      customerNote
                      refundedQuantity
                      }
                  }
              }
          }
      }
      ';

    $response = Http::withHeaders([
        'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);

    if(isset($response->json()['errors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['errors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['return'];
    }
    return $return;

  }
  public function getOrderOnlyFullfillment()  {
    $query ='
    {
      order(id:"gid://shopify/Order/5625862684993"){
        fulfillmentOrders(first:3){
          edges{
            node{
              status
              lineItems(first:100){
                edges{
                  node{
                    id
                  }
                  cursor
                }
              }
              assignedLocation{
                name
              }
            }
            cursor
          }
        }
      }
    }
    ';

    $response = Http::withHeaders([
        'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);

    if(isset($response->json()['errors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['errors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['order'];
    }
    return $return;
  }
  public function getOrderForReturn($OrderID){
    $query = '
    {
      order(id: "gid://shopify/Order/'.$OrderID.'") {
          id
          name
          createdAt
          updatedAt
          customerLocale
          returns(first:10){
            edges{
              node{
                status
                returnLineItems(first:10){
                  edges{
                    node{
                      quantity
                      returnReason
                      fulfillmentLineItem{
                        id
                        lineItem{
                          id
                          sku
                          title
                          discountedUnitPriceSet{
                            presentmentMoney{
                              amount
                            }
                          }
                          taxLines{
                            rate
                            priceSet{
                              presentmentMoney{
                                amount
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
          fulfillments(first:10){
            status
            location{
              name
            }
            fulfillmentLineItems(first:10){
              edges{
                node{
                  id
                }
              }
            }
          }
          shippingLine{
              carrierIdentifier
              code
              title
              discountedPriceSet{
                presentmentMoney{
                  amount
                  currencyCode
                }
              }
          }
          currencyCode
          customer{
            displayName
            email
          }
          billingAddress{
            name
            firstName
            lastName
            countryCodeV2
            customer
            address1
            address2
            city
            zip
            country
            phone
            province
            provinceCode
          }
          shippingAddress{
            name
            firstName
            lastName
            countryCodeV2
            customer
            address1
            address2
            city
            zip
            phone
            country
            province
            provinceCode
          }
      }
    }
    ';
    $response = Http::withHeaders([
      'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);

    if(isset($response->json()['errors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['errors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['order'];
    }

    return $return;
  }
  public function getOrderForCoulance($OrderID){
    $query = '
    {
      order(id: "gid://shopify/Order/'.$OrderID.'") {
          id
          name
          createdAt
          updatedAt
          customerLocale
          refunds(first:10){
            totalRefundedSet{
              presentmentMoney{
                amount
              }
            }
            return{
              status
              returnLineItems(first:10){
                edges{
                  node{

                    returnReason
                    fulfillmentLineItem{
                      lineItem{
                        id
                      }
                    }
                  }
                }
              }
            }
            refundLineItems(first:10){
              edges{
                node{

                  location{
                    name
                  }
                  quantity

                  lineItem{
                    id
                    sku
                    title
                    taxLines{
                      rate
                      priceSet{
                        presentmentMoney{
                          amount
                        }
                      }
                    }
                  }
                  priceSet{
                    presentmentMoney{
                      amount

                    }
                  }
                }
              }
            }
          }
          shippingLine{
              carrierIdentifier
              code
              title
              discountedPriceSet{
                presentmentMoney{
                  amount
                  currencyCode
                }
              }
          }
          currencyCode
          customer{
            displayName
            email
          }
          billingAddress{
            name
            firstName
            lastName
            countryCodeV2
            customer
            address1
            address2
            city
            zip
            country
            phone
            province
            provinceCode
          }
          shippingAddress{
            name
            firstName
            lastName
            countryCodeV2
            customer
            address1
            address2
            city
            zip
            phone
            country
            province
            provinceCode
          }
      }
    }
    ';
    $response = Http::withHeaders([
      'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);

    if(isset($response->json()['errors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['errors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['order'];
    }

    return $return;
  }
  public function getProductVariant($variantID){

    $query = '
      {
        productVariant(id: "gid://shopify/ProductVariant/'.$variantID.'") {
          barcode
          compareAtPrice
          sku
          image{
            url
          }
          product{
              featuredImage{
                  url
              }
          }
        }
      }
    ';
    $response = Http::withHeaders([
      'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);


    if($response->json() == null){

      $return['error'] = true;
      $return['response'] = $response->json();

      return $return;
    }
    if(isset($response->json()['errors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['errors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['productVariant'];
    }

    return $return;
  }
  public function capturePayment($variables){
    $mutation = '
        mutation orderCapture($input: OrderCaptureInput!) {
          orderCapture(input: $input) {
            userErrors {
                field
                message
            }
            transaction {
                status
                errorCode
            }
          }
        }
    ';
    $response = Http::withHeaders([
      'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $mutation,
        'variables' => $variables,
    ]);

    if(isset($response->json()['errors'])){

      $return['error'] = true;
      $return['response'] = $response->json();
      return $return;
      
    }

    if(isset($response->json()['data']['orderCapture']['userErrors']) && !empty($response->json()['data']['orderCapture']['userErrors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['data']['orderCapture']['userErrors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['orderCapture']['transaction'];
    }

    return $return;
  }
  public function updateVarient($data){
    $mutation = '
      mutation productVariantUpdate($input: ProductVariantInput!) {
        productVariantUpdate(input: $input) {
          productVariant {
            id
          }
          userErrors {
            field
            message
          }
        }
      }
    ';
    $response = Http::withHeaders([
      'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $mutation,
        'variables' => $data,
    ]);
    if(isset($response->json()['data']['productVariantUpdate']['userErrors']) && !empty($response->json()['data']['productVariantUpdate']['userErrors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['data']['productVariantUpdate']['userErrors'];
    }else{

        if(isset($response->json()['data']['productVariantUpdate']['productVariant'])){
          $return['error'] = false;
          $return['response'] = $response->json()['data']['productVariantUpdate']['productVariant'];
        } else {
          $return['error'] = true;
          $return['response'] = $response->json();
        }
      
    }

    return $return;
  }
  public function splitFulfillmentOrder($data){
    $mutation = '
      mutation fulfillmentOrderSplit($fulfillmentOrderSplits: [FulfillmentOrderSplitInput!]!) {
        fulfillmentOrderSplit(fulfillmentOrderSplits: $fulfillmentOrderSplits) {
          fulfillmentOrderSplits {
            fulfillmentOrder {
              id
              lineItems(first: 10) {
                edges {
                  cursor
                  node {
                    id
                    totalQuantity
                  }
                }
              }
            }
            remainingFulfillmentOrder {
              id
              lineItems(first: 10) {
                edges {
                  cursor
                  node {
                    id
                    totalQuantity
                  }
                }
              }
            }
          }
          userErrors {
            field
            message
          }
        }
      }
    ';
    $response = Http::withHeaders([
      'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $mutation,
        'variables' => $data,
    ]);

   
    if(isset($response->json()['data']['fulfillmentOrderSplit']['userErrors']) && !empty($response->json()['data']['fulfillmentOrderSplit']['userErrors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['data']['fulfillmentOrderSplit']['userErrors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['fulfillmentOrderSplit']['fulfillmentOrderSplits'];
    }

    return $return;
  }

  public function getFulfillmentOrderByFulfillmentID($FulfillmentID){

    $query = '
    {
      fulfillment(id:"'.$FulfillmentID.'"){
        fulfillmentOrders(first:10){
          edges{
            node{
              id
            }
          }
        }
      }
    }
    ';
    $response = Http::withHeaders([
      'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);


    if($response->json() == null){

      $return['error'] = true;
      $return['response'] = $response->json();

      return $return;
    }
    if(isset($response->json()['errors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['errors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['fulfillment'];
    }

    return $return;
  }

  public function getOrderFullfillmentById($FullfillmentID){
    $query = '
      {
        fulfillmentOrder(id: "'.$FullfillmentID.'") {
          order{
            id
          }
        }
      }
    ';
    
    $response = Http::withHeaders([
      'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);

    // dd($response->json());
    if($response->json() == null){

      $return['error'] = true;
      $return['response'] = $response->json();

      return $return;
    }
    if(isset($response->json()['errors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['errors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['fulfillmentOrder'];
    }

    return $return;
  }

  public function getOnHandInventory($InventoryLevelId){
    $query = '
       {
        inventoryLevel(id:"'.$InventoryLevelId.'"){
          quantities(names:"on_hand"){
            quantity
            name
          }
        }
      }
    ';
    $response = Http::withHeaders([
      'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query,
    ]);
    if(isset($response->json()['errors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['errors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['inventoryLevel'];
    }

    return $return;
  }

  public function createProduct($variables){
    $mutation = '
      mutation productCreate($input: ProductInput!) {
        productCreate(input: $input) {
          product {
            id
          }
          userErrors {
            field
            message
          }
        }
      }
    ';
    $response = Http::withHeaders([
      'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $mutation,
        'variables' => $variables,
    ]);
    // p($response->json());
    if(isset($response->json()['data']['productCreate']['userErrors']) && !empty($response->json()['data']['productCreate']['userErrors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['data']['productCreate']['userErrors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['productCreate']['product'];
    }

    return $return;
  }

  public function CreateWebhook($ShopifyBulkOperationsFileID){

    $mutation = '
      mutation {
        webhookSubscriptionCreate(
          topic: BULK_OPERATIONS_FINISH
          webhookSubscription: {
            format: JSON,
            callbackUrl: "'.env('APP_URL').'/shopify/webhooks/'.$ShopifyBulkOperationsFileID.'"}
        ) {
          userErrors {
            field
            message
          }
          webhookSubscription {
            id
          }
        }
      }
    ';
    $response = Http::withHeaders([
      'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $mutation
    ]);

    if(isset($response->json()['data']['webhookSubscriptionCreate']['userErrors']) && !empty($response->json()['data']['webhookSubscriptionCreate']['userErrors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['data']['webhookSubscriptionCreate']['userErrors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['webhookSubscriptionCreate']['webhookSubscription'];
    }

    return $return;

  }

  public function CreateWebhookNew($topic, $url){

    $mutation = '
      mutation {
        webhookSubscriptionCreate(
          topic: '.$topic.'
          webhookSubscription: {
            format: JSON,
            callbackUrl: "'.$url.'"}
        ) {
          userErrors {
            field
            message
          }
          webhookSubscription {
            id
          }
        }
      }
    ';
    $response = Http::withHeaders([
      'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $mutation
    ]);

    if(isset($response->json()['data']['webhookSubscriptionCreate']['userErrors']) && !empty  ($response->json()['data']['webhookSubscriptionCreate']['userErrors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['data']['webhookSubscriptionCreate']['userErrors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['webhookSubscriptionCreate']['webhookSubscription'];
    }

    return $return;

  }

  public function getWebhooks(){

    $query = '
      {
        webhookSubscriptions(first:20) {
          edges{
            node{
              id
              callbackUrl
              endpoint
              topic
            }
          }
        }
      }
    ';
    $response = Http::withHeaders([
      'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);

    if(isset($response->json()['errors']) && !empty($response->json()['errors'])){
      $return['error'] = true;
      $return['response'] = $response->json()['errors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['webhookSubscriptions'];
    }
    return $return;

  }

  public function deleteWebhook($id){
    $mutation = '
      mutation {
        webhookSubscriptionDelete(id:"'.$id.'") {
          deletedWebhookSubscriptionId
          userErrors {
            field
            message
          }
        }
      }
    ';
    $response = Http::withHeaders([
      'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $mutation
    ]);

    if(isset($response->json()['data']['webhookSubscriptionDelete']['userErrors']) && !empty($response->json()['data']['webhookSubscriptionDelete']['userErrors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['data']['webhookSubscriptionDelete']['userErrors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['webhookSubscriptionDelete'];
    }

    return $return;
  }

  public function updateWebhook($id, $url){
      $mutation = '
          mutation webhookSubscriptionUpdate($id: ID!, $webhookSubscription: WebhookSubscriptionInput!) {
              webhookSubscriptionUpdate(id: $id, webhookSubscription: $webhookSubscription) {
                  userErrors {
                      field
                      message
                  }
                  webhookSubscription {
                      id
                  }
              }
          }
      ';
      $variables = array();
      $variables['id'] = $id;
      $variables['webhookSubscription']['callbackUrl'] = $url;

      $response = Http::withHeaders([
        'X-Shopify-Access-Token' =>  $this->accessToken,
      ])->post($this->url, [
          'query' => $mutation,
          'variables' => $variables,
      ]);

      if(isset($response->json()['data']['webhookSubscriptionUpdate']['userErrors']) && !empty($response->json()['data']['webhookSubscriptionUpdate']['userErrors'])){
          $return['error'] = true;
          $return['response'] = $response->json()['data']['webhookSubscriptionUpdate']['userErrors'];
      }else{
          $return['error'] = false;
          $return['response'] = $response->json()['data']['webhookSubscriptionUpdate'];
      }

      return $return;
  }

  public function getReturnByOrderID($OrderID){
    $query = '
    {
      order(id:"gid://shopify/Order/'.$OrderID.'"){
        returns(first:10, query:"status:OPEN"){
          nodes{
            id
            status
            totalQuantity
            returnLineItems(first:10){
              nodes{
                quantity
                returnReason
                returnReasonNote
                fulfillmentLineItem{
                  id
                  lineItem{
                    title
                    sku
                    id
                    originalUnitPriceSet{
                      presentmentMoney{
                        amount
                      }
                    }
                    discountedUnitPriceSet{
                      presentmentMoney{
                        amount
                      }
                    }
                    taxLines{
                      rate
                      priceSet{
                        presentmentMoney{
                          amount
                        }
                      }
                    }
                  }
                }
                withCodeDiscountedTotalPriceSet{
                  presentmentMoney{
                    amount
                    currencyCode
                  }
                }
              }
            }
          }
        }
      }
    }
    ';
    $response = Http::withHeaders([
      'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);

    if(isset($response->json()['errors']) && !empty($response->json()['errors'])){
      $return['error'] = true;
      $return['response'] = json_encode($response->json()['errors']);
    }else{
      $return['error'] = false;
      $return['response'] = $response->json()['data']['order'];
    }

    return $return;
  }

  public function getReturn($ReturnID){
    $query = '
    {
      return(id:"'.$ReturnID.'"){
        id
        status
        totalQuantity
        returnLineItems(first:10){
          nodes{
            quantity
            returnReason
            returnReasonNote
            fulfillmentLineItem{
              id
              lineItem{
                title
                sku
                id
                originalUnitPriceSet{
                  presentmentMoney{
                    amount
                  }
                }
                discountedUnitPriceSet{
                  presentmentMoney{
                    amount
                  }
                }
                taxLines{
                  rate
                  priceSet{
                    presentmentMoney{
                      amount
                    }
                  }
                }
              }
            }
            withCodeDiscountedTotalPriceSet{
              presentmentMoney{
                amount
                currencyCode
              }
            }
          }
        }
      }
    }
    ';
    $response = Http::withHeaders([
      'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);

    if(isset($response->json()['errors']) && !empty($response->json()['errors'])){
      $return['error'] = true;
      $return['response'] = json_encode($response->json()['errors']);
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['return'];
    }
    return $return;
  }

  public function createBulkOperation($FilePath, $FileFor){
      $mutation = '
          mutation {
              stagedUploadsCreate(
                  input:{
                      resource:BULK_MUTATION_VARIABLES,
                      filename: "'.pathinfo($FilePath,PATHINFO_FILENAME).'",
                      mimeType: "text/jsonl",
                      httpMethod: POST
                  }
              )
              {
                  userErrors{
                      field,
                      message
                  },
                  stagedTargets{
                      url,
                      resourceUrl,
                      parameters {
                          name,
                          value
                      }
                  }
              }
          }
      ';
      $response = Http::withHeaders([
          'X-Shopify-Access-Token' =>  $this->accessToken,
      ])->post($this->url, [
          'query' => $mutation
      ]);

      if(isset($response->json()['data']['stagedUploadsCreate']['userErrors']) && !empty($response->json()['data']['stagedUploadsCreate']['userErrors'])){
          $return['error'] = true;
          $return['response'] = json_encode($response->json()['data']['stagedUploadsCreate']['userErrors']);

          return $return;
      }

      $stagedUploadsCreateResponse = $response->json()['data']['stagedUploadsCreate'];


      $params = $stagedUploadsCreateResponse['stagedTargets']['0']['parameters'];

      $postData = array();

      foreach($params as $param){

          if($param['name'] == 'key'){
            $postData['key'] = $param['value'];
          }
          if($param['name'] == 'x-goog-credential'){
            $postData['x-goog-credential'] = $param['value'];
          }
          if($param['name'] == 'x-goog-algorithm'){
            $postData['x-goog-algorithm'] = $param['value'];
          }

          if($param['name'] == 'x-goog-date'){
            $postData['x-goog-date'] = $param['value'];
          }
          if($param['name'] == 'x-goog-signature'){
            $postData['x-goog-signature'] = $param['value'];
          }
          if($param['name'] == 'policy'){
            $postData['policy'] = $param['value'];
          }
          if($param['name'] == 'acl'){
            $postData['acl'] = $param['value'];
          }
          if($param['name'] == 'Content-Type'){
            $postData['Content-Type'] = $param['value'];
          }
          if($param['name'] == 'success_action_status'){
            $postData['success_action_status'] = $param['value'];
          }
      }
      $pt = storage_path().'/app/'.$FilePath;
      
      

      // dd(Storage::disk('local')->get($FilePath));
      $postData['file'] =new \CURLFile($pt);
      // dd($pt);
      $url = $stagedUploadsCreateResponse['stagedTargets']['0']['url'];

      $headers = array("Content-Type:multipart/form-data");
      $curl = curl_init($url);
      curl_setopt( $curl, CURLOPT_HEADER, TRUE );
      curl_setopt( $curl, CURLOPT_HTTPHEADER, $headers);
      curl_setopt( $curl, CURLOPT_RETURNTRANSFER, TRUE );
      curl_setopt($curl, CURLOPT_POST, true);

      curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);

      $response = curl_exec($curl);


      curl_close($curl);

      // $responseStageUpload = Http::post($url, $postData);
      //dd($postData);
      switch($FileFor){
          case 'InsertProduct':
              return $this->bulkProductInsert($postData['key']);
              break;
          case 'UpdateProduct':
              //return $this->bulkProductUpdate($postData['key']);
              return $this->bulkProductSet($postData['key']);

              break;
          case 'MetafieldUpdate':
            return $this->bulkProductMetafieldUpdate($postData['key']);
            break;
      }


  }
  public function bulkProductSet($key){

      $mutationBulk = '
      mutation {
        bulkOperationRunMutation(
          mutation: "mutation call($productSet: ProductSetInput!, $synchronous: Boolean!) {
            productSet(synchronous: $synchronous, input: $productSet) {
              product {
                id
                title
                  metafields(first: 60) {
                  edges {
                    node {
                      id
                      key
                      namespace
                      type
                      value
                    }
                  }
                }
              }
              productSetOperation {
                  id
                  status
                  userErrors {
                      code
                      field
                      message
                  }
              }
              userErrors {
                field
                message
              }
            }
        }",
        stagedUploadPath: "' . $key . '") {
          bulkOperation {
            id
            url
            status
          }
          userErrors {
            message
            field
          }
        }
      }
    ';
      $responseBulkMuta = Http::withHeaders([
          'X-Shopify-Access-Token' =>  $this->accessToken,
      ])->post($$this->url, [
          'query' => $mutationBulk
      ]);

      if (isset($responseBulkMuta->json()['data']['bulkOperationRunMutation']['userErrors']) && !empty($responseBulkMuta->json()['data']['bulkOperationRunMutation']['userErrors'])) {
          $return['error'] = true;
          $return['response'] = json_encode($responseBulkMuta->json()['data']['bulkOperationRunMutation']['userErrors']);
          return $return;
      }

      $return['error'] = false;
      $return['response'] = $responseBulkMuta->json()['data']['bulkOperationRunMutation']['bulkOperation'];

      return $return;
  }

  public function bulkProductMetafieldUpdate($key){
    $newurl = 'https://'.$this->shopifyDomain.'/admin/api/2023-07/graphql.json';
    $mutationBulk = '
      mutation {
        bulkOperationRunMutation(
          mutation: "mutation metafieldsSet($metafields: [MetafieldsSetInput!]!) {
            metafieldsSet(metafields: $metafields) {
              metafields {
                id
                key
                value
                namespace
                type
              }
              userErrors {
                field
                message
              }
            }
          }",
        stagedUploadPath: "'. $key.'") {
          bulkOperation {
            id
            url
            status
          }
          userErrors {
            message
            field
          }
        }
      }
    ';
    $responseBulkMuta = Http::withHeaders([
        'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($newurl, [
        'query' => $mutationBulk
    ]);

    //dd($responseBulkMuta->json());
    if(isset($responseBulkMuta->json()['data']['bulkOperationRunMutation']['userErrors']) && !empty($responseBulkMuta->json()['data']['bulkOperationRunMutation']['userErrors'])){
        $return['error'] = true;
        $return['response'] = json_encode($responseBulkMuta->json()['data']['bulkOperationRunMutation']['userErrors']);
        return $return;
    }

    $return['error'] = false;
    $return['response'] = $responseBulkMuta->json()['data']['bulkOperationRunMutation']['bulkOperation'];

    return $return;
  }
  public function getBulkFileURL($bulkOperationID){
      $query = '
      query{
              node(id: "'.$bulkOperationID.'") {
              ... on BulkOperation {
                  url
                  partialDataUrl
              }
              }
          }
      ';
      $response = Http::withHeaders([
          'X-Shopify-Access-Token' =>  $this->accessToken,
      ])->post($this->url, [
          'query' => $query
      ]);


      if(isset($response->json()['data']) && $response->json()['data']['node'] != null){
          $return['error'] = false;
          $return['response'] = $response->json()['data'];

          return $return;

      } else{

          $return['error'] = true;
          $return['response'] = 'response URL not found';

          return $return;
      }

  }
  public function ExecuteBulkProductImport(){
      $query = '
              mutation {
                  bulkOperationRunQuery(
                  query: """
                  {
                      inventoryItems{
                          edges{
                            node{
                              id
                              sku
                              variant{
                                id
                                barcode
                                product{
                                  id
                                }
                              }
                              inventoryLevels(first:100){
                                edges{
                                  node{
                                    quantities(names:"available"){
                                      name
                                      quantity
                                    }
                                    location {
                                      id
                                      metafield(key:"store_id", namespace:"custom"){
                                        value
                                      }
                                    }
                                  }
                                }
                              }

                            }
                          }
                        }
                  }
                  """
                  ) {
                      bulkOperation {
                          id
                          status
                      }
                      userErrors {
                          field
                          message
                      }
                  }
              }

      ';
      $response = Http::withHeaders([
          'X-Shopify-Access-Token' =>  $this->accessToken,
      ])->post($this->url, [
          'query' => $query
      ]);

      //dd($response->json());
      if(empty($response->json()['data']['bulkOperationRunQuery']['userErrors'])){
          $return['error'] = false;
          $return['response'] = $response->json()['data']['bulkOperationRunQuery']['bulkOperation'];

          return $return;

      } else{

          $return['error'] = true;
          $return['response'] = json_encode($response->json()['data']['bulkOperationRunQuery']['userErrors']);

          return $return;
      }

  }

  public function ExecuteBulkInventoryImport($LocationID, $store_id){

    $names = '';
    switch($store_id){
      case "1901":
      case "1902":
      case "1000":
      case "1903":
      case "1904":
      case "IPS":
        $names = 'available';
      default:
        $names = 'on_hand';
    }
    $query = '
            mutation {
                bulkOperationRunQuery(
                query: """
                {
                  productVariants(query:"inventory_quantity:>0 AND location_id:'.$LocationID.'"){
                    edges{
                      node{
                        sku
                        inventoryItem{
                          id
                          inventoryLevel(locationId:"gid://shopify/Location/'.$LocationID.'"){
                            quantities(names:"'.$names.'"){
                              quantity
                            }
                            location{
                              id
                              metafield(key:"store_id" namespace:"custom"){
                                value
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
                """
                ) {
                    bulkOperation {
                        id
                        status
                    }
                    userErrors {
                        field
                        message
                    }
                }
            }

    ';
    $response = Http::withHeaders([
        'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);

    //dd($response->json());
    if(empty($response->json()['data']['bulkOperationRunQuery']['userErrors'])){
        $return['error'] = false;
        $return['response'] = $response->json()['data']['bulkOperationRunQuery']['bulkOperation'];

        return $return;

    } else{

        $return['error'] = true;
        $return['response'] = json_encode($response->json()['data']['bulkOperationRunQuery']['userErrors']);

        return $return;
    }

  }

  public function ExecuteBulkInventoryImportHourly($lastdate){

    $query = '
            mutation {
                bulkOperationRunQuery(
                query: """
                {
                  locations{
                    edges{
                      node{
                        id
                        metafield(namespace:"custom" key:"store_id"){
                          value
                        }
                        inventoryLevels(query:"updated_at:>'.$lastdate.'"){
                          edges{
                            node{
                              id
                              item{
                                sku
                              }
                              quantities(names:["available", "on_hand"]){
                                name
                                quantity
                              }

                            }
                          }
                        }
                      }
                    }
                  }
                }
                """
                ) {
                    bulkOperation {
                        id
                        status
                    }
                    userErrors {
                        field
                        message
                    }
                }
            }

    ';
   
    $response = Http::withHeaders([
        'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);

    //dd($response->json());
    if(empty($response->json()['data']['bulkOperationRunQuery']['userErrors'])){
        $return['error'] = false;
        $return['response'] = $response->json()['data']['bulkOperationRunQuery']['bulkOperation'];

        return $return;

    } else{

        $return['error'] = true;
        $return['response'] = json_encode($response->json()['data']['bulkOperationRunQuery']['userErrors']);

        return $return;
    }
   

  }

  public function updateInventory($param){
    $mutation = '
       mutation inventorySetQuantities($input: InventorySetQuantitiesInput!) {
        inventorySetQuantities(input: $input) {
          inventoryAdjustmentGroup {
            reason
            referenceDocumentUri
            changes {
              name
              delta
              quantityAfterChange
              item{
                sku
              }
              location{
                metafield(namespace:"custom", key:"store_id"){
                  value
                }
              }
            }
          }
          userErrors {
            field
            message
          }
        }
      }
    ';

    $response = Http::withHeaders([
        'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $mutation,
        'variables' => $param,
    ]);
    //dd($response->json());
    if(isset($response->json()['data']['inventorySetQuantities']['userErrors']) && !empty($response->json()['data']['inventorySetQuantities']['userErrors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['data']['inventorySetQuantities']['userErrors'];
    }else{

      if(isset($response->json()['data']['inventorySetQuantities']['inventoryAdjustmentGroup'])){
        $return['error'] = false;
        $return['response'] = $response->json()['data']['inventorySetQuantities']['inventoryAdjustmentGroup'];
      } else {
        $return['error'] = true;
        $return['response'] = $response->json();
      }
        
    }

    return $return;
  }
  
  public function getInventoryDataOLD($inventoryItemId) {
      $query = '
          {
              inventoryItem(id: "gid://shopify/InventoryItem/'.$inventoryItemId.'") {
                  id
                  sku
                  variant {
                      id
                      barcode
                      product {
                          id
                      }
                  }
                  inventoryLevels(first: 100) {
                      edges {
                          node {
                              quantities(names: "available") {
                                  name
                                  quantity
                              }
                              location {
                                  id
                                  metafield(key:"store_id", namespace:"custom"){
                                    value
                                  }
                              }
                          }
                      }
                  }
              }
          }
      ';

      $response = Http::withHeaders([
          'X-Shopify-Access-Token' =>  $this->accessToken,
      ])->post($this->url, [
          'query' => $query
      ]);

      // dd($response->json());
      if(isset($response->json()['errors'])){
          $return['error'] = true;
          $return['msg'] = $response->json()['errors'];
      }else{
          $return['error'] = false;
          $return['response'] = $response->json()['data']['inventoryItem'];
      }
      return $return;
  }

  public function getInventoryData($inventoryItemId, $LocationId) {
    $query = '
    {
      inventoryItem(id: "gid://shopify/InventoryItem/'.$inventoryItemId.'") {
        id
        sku
        variant {
            id
            barcode
            product {
                id
            }
        }
        inventoryLevel(locationId:"gid://shopify/Location/'.$LocationId.'"){
          quantities(names:"available"){
            name
            quantity
          }
          location{
             id
              metafield(key:"store_id", namespace:"custom"){
                value
              }
          }
        }
      }
    }
    ';

    $response = Http::withHeaders([
        'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query
    ]);

    // dd($response->json());
    if(isset($response->json()['errors'])){
        $return['error'] = true;
        $return['msg'] = $response->json()['errors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['inventoryItem'];
    }
    return $return;
  }

  public function bulkOperationCancel($id){
    $variables = array();
    $variables['id'] = $id;
    $query = '
      mutation bulkOperationCancel($id: ID!) {
        bulkOperationCancel(id: $id) {
          bulkOperation {
            id
          }
          userErrors {
            field
            message
          }
        }
      }
    ';

    $response = Http::withHeaders([
        'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query,
        'variables' => $variables,
    ]);

    if(isset($response->json()['data']['bulkOperationCancel']['userErrors'])){
        $return['error'] = true;
        $return['response'] = $response->json()['userErrors'];
    }else{
        $return['error'] = false;
        $return['response'] = $response->json()['data']['bulkOperationCancel'];
    }
    return $return;
  }

  public function currentBulkOperation(){
    $query = '
      {
        currentBulkOperation {
          id
          status
          errorCode
          createdAt
          completedAt
          objectCount
          fileSize
          url
          partialDataUrl
        }
      }
    ';
    $response = Http::withHeaders([
        'X-Shopify-Access-Token' =>  $this->accessToken,
    ])->post($this->url, [
        'query' => $query,
    ]);
    return $response->json();
  }

}