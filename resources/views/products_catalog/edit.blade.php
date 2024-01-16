@extends('layouts.app')

@section('content')
  <h4 class="">ID: {{$data->erp_id}}</h4><p>
  <h4>sku: {{$data->sku}}</h4><p>

    <h4>product_type: {{$data->product_type}}</h4><p>
      <h4>product_name: {{$data->product_name}}</h4><p>
        <h4>description: {{$data->description}}</h4><p>
          <h4>categories: {{$data->categories}}</h4><p>
            <h4>warranty: {{$data->warranty}}</h4><p>
              <h4>product_availability: {{$data->product_availability}}</h4><p>
                <h4>brand: {{$data->brand}}</h4><p>
                  <h4>gtin_ean: {{$data->gtin_ean}}</h4><p>
                    <h4>unit: {{$data->unit}}</h4><p>
                      <h4>ncm: {{$data->ncm}}</h4><p>
                        <h4>tax_origin: {{$data->tax_origin}}</h4><p>
                          <h4>price_cost: {{$data->price_cost}}</h4><p>
                            <h4>price_sale: {{$data->price_sale}}</h4><p>
                              <h4>active: {{$data->active}}</h4><p>
                                <h4>seo_title: {{$data->seo_title}}</h4><p>
                                  <h4>seo_description: {!!$data->seo_description!!}</h4><p>
                                    <h4>seo_keywords: {{$data->seo_keywords}}</h4><p>
                                      <h4>weight: {{$data->weight}}</h4><p>
                                        <h4>height: {{$data->height}}</h4><p>
                                          <h4>width: {{$data->width}}</h4><p>
                                            <h4>length: {{$data->length}}</h4><p>
                                              <h4>supplier_id: {{$data->supplier_id}}</h4><p>
@dump($data)
@endsection
