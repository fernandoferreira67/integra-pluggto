@extends('layouts.app')

@section('content')
<div><h3>-> MAGALU</h3></div>

<div class="my-4 p-4 bg-cyan-400">
  <h5>Importar Planilha</h5>

  <form action="{{ route('magalu.import')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" required>
    <input type="submit" class="btn btn-primary" value="Enviar">
    <legend><h6><span>Enviar .XLS Magalu para database!</span></h6></legend>
  </form>
</div>

<div class="my-2">
  <a href="{{ route('magalu.interconnection')}}" class="inline-block rounded bg-amber-300 px-6 pb-2 pt-2.5 text-xs font-medium uppercase">Correlacionar</a>
  <a href="{{ route('magalu.export')}}" class="bg-sky-500/100 inline-block px-6 pb-2 pt-2.5 text-xs font-medium uppercase">Exporta Arquivo</a>
  <a href="{{ route('magalu.newDatabase')}}" class="inline-block rounded bg-pink-600 px-6 pb-2 pt-2.5 text-xs font-medium uppercase">Limpar Database</a>
</div>

<form action="{{ route('magalu.index.search')}}" method="post" class="my-2">
  @csrf
  <input type="text" class="border-2 border-amber-200" name="search" value="">
  <input type="submit" class="inline-block rounded bg-amber-300 px-6 pb-2 pt-2.5 text-xs font-medium uppercase" value="Consultar Não Correlacionados">
</form>


<div>TOTAL:<span>{{count($data)}}</span> / Não Correlacionado:{{count($filter['not_search'])}} / Não Sincronizados:{{count($filter['not_sync'])}} / Sincronizados:{{count($filter['sync'])}} </div>
<div class="container-auto mt-5">
  <table class="min-w-full border text-sm font-light dark:border-neutral-500">
    <thead class="border-b font-medium dark:border-neutral-500">
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
</div>
@dump($data);
@endsection
