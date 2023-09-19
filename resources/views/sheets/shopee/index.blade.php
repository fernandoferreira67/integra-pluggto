@extends('layouts.app')

@section('content')
<div class="bg-shopee">
<div><h3>-> Shopee</h3></div>

<div class="my-4 p-4 bg-secondary">
  <h5>Importar Planilha</h5>

  <form action="{{ route('shopee.import')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" required>
    <input type="submit" class="btn btn-primary" value="Enviar">
    <legend><h6><span>Enviar .XLS shopee para database!</span></h6></legend>
  </form>
</div>

<div>TOTAL DE PRODUTOS CARREGADOS:<span>{{count($data)}}</span> / Sem correlação:{{count($filter)}} </div>

<a href="{{ route('shopee.interconnection')}}" class="btn btn-success">Gerar Correlação</a>
<a href="{{ route('shopee.export')}}" class="btn btn-info">Exporta Arquivo</a>
<a href="{{ route('shopee.newDatabase')}}" class="btn btn-info">Limpar Database</a>

<table class="table mt-4">
  <thead>
    <tr>
      <th scope="col">SKU PLUGG.TO</th>
      <th scope="col">*EXTERNAL SKU</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $product)
      <tr>
        <td>{{ $product->pluggto_sku }}</td>
        <td>{{ $product->external_sku}}</td>
      </tr>
    @endforeach
  </tbody>
</table>
</div>

@dump($data)
@endsection
