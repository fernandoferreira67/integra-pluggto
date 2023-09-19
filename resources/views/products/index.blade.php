@extends('layouts.app')

@section('content')
<div class="d-flex p-2">
 <h3> CATALOGO</h3>
</div>

<div class="my-4 bg-secondary p-4">
  <h5>Importar Produtos</h5>
  <form action="{{ route('products.import')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" required>
    <select class="" name="type">
      <option>Selecione Qual tipo do Arquivo</option>
      <option  value="1">Produtos</option>
      <option  value="2">GVM</option>
    </select>
    <input type="submit" class="btn btn-primary" value="Enviar">
    <legend><h6><span>Enviar dados .XLS para database!</span></h6></legend>
  </form>
</div>
<div>
  <form action="{{ route('products.index')}}" method="post">
    @csrf
    <input type="hidden" name="search" value="OK">
    <input type="submit" class="btn btn-warning" value="Consultar">
  </form>
</div>

<a href="{{ route('products.readApi')}}" class="btn btn-success my-4">Correlacionar com PLUGGTO</a>
<a href="{{ route('products.force.sync')}}" class="btn btn-info my-4">Reprocessar</a>
<a href="{{ route('products.sync')}}" class="btn btn-success my-4">Correlacionar com GVM</a>

<span>CADASTRO com SYNC: {{count($data)}} / CADASTRO NÃO sync {{count($integration)}}/ GVM sem SYNC: {{count($gvm)}}/ </span>

<table class="table mt-4">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">ID GVM</th>
      <th scope="col">SKU GVM</th>
      <th scope="col">SKU PLUGGTO</th>
      <th scope="col">PRODUTO</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $product)
      <tr>
          <td>{{ $product->id }}</td>
          <td>{{ $product->id_gvm }}</td>
          <td>{{ $product->sku_gvm }}</td>
          <td>{{ $product->sku_pluggto }}</td>
          <td>{{ $product->product_name }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

@endsection
