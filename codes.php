<?php

class plublic {

  public function interconnection()
    {
      $products =  $this->product->all();
      $magalu = $this->magalu->all();

      foreach ($magalu as $i => $value) {

      $sku =  $this->checkSku($value->external_sku);

      //dd($value);




          //echo  Str::replace('*', '', $value->external_sku);
          //DB::table('products')->where('sku_gvm', '=', Str::replace('*', '', $value->external_sku))->get();

          //echo $value->external_sku[$indice] . " RESULTADO:" .  $result . "</br>";
          //dd($result = DB::table('products')->where('sku_gvm', '=', $value->external_sku ));

          //echo $value->external_sku . "</br>";
          if($sku->count()){

            $param = [
              "pluggto_sku" => '*'. $sku[0]->sku_pluggto,
              "pluggto_parent_sku" => '*'. $sku[0]->sku_pluggto,
            ];


            $value->update($param);
            //dump ($sku[0]->sku_pluggto);

          }else{
            echo '<hr> <p>';
          }

          //dd($value);
        //dump($check[$i]);
      }

      //dd('parou');


      return redirect()->route('magalu.index');
    }


}


 //dd($response->json());
      //dd($body);
      //echo "Status: " . $response->getStatusCode() . PHP_EOL;




      foreach ($data as $i=>$value){
        Log::alert('Adicionando produtos da API na database!');

        $params = [
          'id_gvm' => $value['id'],
          'sku_gvm' => $value['id'],
          'sku_pluggto' => $value['id'],
          'product_name' => $value['title'],
        ];

        $product = DB::table('products')->where('sku_gvm', '=', $value['id'])->get();

        if($product->isEmpty()){
          Log::notice('Sku adicionado ao database: {id}', ['id' =>  $value['id']]);
          dump($product);
          $this->product::create($params);
          continue;
        }

        Log::info('Sku já existente: {id}', ['id' =>  $value['id']]);

      }





      public function readApi($sku)
      {

        /*$response = Http::withHeaders([
          'Content-Type' => 'application/json',
        ])->get('https://fakestoreapi.com/products');*/

        //$response = Http::withToken('121055196c177696ade524aec37fb77cabacf7cd')->get('https://api.plugg.to/products');

        $response = Http::withToken('121055196c177696ade524aec37fb77cabacf7cd')->get('https://api.plugg.to/skus/173594p');

        //$body = $response->getBody()->__toString();

        //dd($body);

        $data = json_decode( (string) $response->getBody(), true );


        if(!isset($data['error'])){
          //echo "encontrou";

          foreach ($data as $i=>$value){

            Log::alert('Adicionando produtos da API na database!');

            $params = [
              'sku_pluggto' => $value['sku'],
              'product_name' => $value['name'],
            ];

            $product = DB::table('products')->where('id_gvm', '=', Str::replace('*', '',  $value['sku']))->get();

            /*if($product->isEmpty()){
              Log::notice('Sku adicionado ao database: {id}', ['id' =>  $value['id']]);
              dump($product);
              $this->product::create($params);
              continue;
            }

            Log::info('Sku já existente: {id}', ['id' =>  $value['id']]);*/

          }
          return redirect()->route('products.index');

        }else{
          return redirect()->route('products.index');
        }


      }
