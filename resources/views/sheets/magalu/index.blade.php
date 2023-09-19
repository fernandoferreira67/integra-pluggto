@extends('layouts.app')

@section('content')
<div><h3>-> MAGALU</h3></div>

<div class="my-4 p-4 bg-secondary">
  <h5>Importar Planilha</h5>

  <form action="{{ route('magalu.import')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" required>
    <input type="submit" class="btn btn-primary" value="Enviar">
    <legend><h6><span>Enviar .XLS Magalu para database!</span></h6></legend>
  </form>
</div>

<a href="{{ route('magalu.interconnection')}}" class="btn btn-success">Correlacionar </a>
<a href="{{ route('magalu.export')}}" class="btn btn-info">Exporta Arquivo</a>
<a href="{{ route('magalu.newDatabase')}}" class="btn btn-warning">Limpar Database</a>

<form action="{{ route('magalu.index.search')}}" method="post">
  @csrf
  <input type="text" name="search" value="">
  <input type="submit" class="btn btn-warning" value="Consultar Não Correlacionados">
</form>


<div>TOTAL:<span>{{count($data)}}</span> / Não Correlacionado:{{count($filter['not_search'])}} / Não Sincronizados:{{count($filter['not_sync'])}} / Sincronizados:{{count($filter['sync'])}} </div>

<table class="table mt-4">
  <thead>
    <tr>
      <th scope="col">SKU PLUGG.TO</th>
      <th scope="col">SKU FILHO</th>
      <th scope="col">*EXTERNAL CODE</th>
      <th scope="col">*EXTERNAL SKU</th>
      <th scope="col">*EXTERNAL PARENT SKU</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $product)
      <tr>
        <td>{{ $product->pluggto_sku }}</td>
        <td>{{ $product->pluggto_parent_sku }}</td>
        <td>{{ $product->external_code }}</td>
        <td>{{ $product->external_sku}}</td>
        <td>{{ $product->external_parent_sku}}</td>
      </tr>
    @endforeach
  </tbody>
</table>

@dump($data);
@endsection
