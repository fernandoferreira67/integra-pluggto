@extends('layouts.app')

@section('content')
<div class="p-4">
<div><h3>-> Olist</h3></div>

<div class="my-4 p-4 border">
  <p class="text-warning">Importar Planilha</p>
  <h5></h5>

  <form action="{{ route('olist.import')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" required>
    <input type="submit" class="btn btn-primary" value="Enviar">
    <legend><h6><span>Enviar .XLS olist para database!</span></h6></legend>
  </form>
</div>

<div class="d-flex justify-content-center">
  <form class="" action="{{ route('olist.index.search')}}" method="post">
    @csrf
    <input type="hidden" name="search" value="OK">
    <input type="submit" class="btn btn-success" value="Consultar Produtos Sem SKU Plug">
  </form>
</div>
<div class="d-flex justify-content-center">
  TOTAL:<span>{{count($data)}}</span> / Sem correlação:{{count($filter['no_sync'])}}
</div>

<div class="d-flex d-flex justify-content-center mt-4">
  <a href="{{ route('olist.interconnection')}}" class="btn btn-success">Correlacionar</a>
  <a href="{{ route('olist.export')}}" class="mx-2 btn btn-dark">Exporta Arquivo</a>
  <a href="{{ route('olist.newDatabase')}}" class="btn btn-danger">Limpar Database</a>
</div>

<table class="table mt-4">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">PRODUTO</th>
      <th scope="col">SKU</th>
      <th scope="col">SKU ERP</th>
      <th scope="col">SKU PLUG</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $product)
      <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->product_name }}</td>
        <td>{{ $product->sku}}</td>
        <td>{{ $product->sku_erp}}</td>
        <td>{{ $product->sku_pluggto}}</td>
      </tr>
    @endforeach
  </tbody>
</table>
</div>

@dump($data)
@endsection
