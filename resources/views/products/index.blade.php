@extends('layouts.app')

@section('content')
<div class="flex justify-center p-2 mt-4">
  <p class="text-2xl font-semibold text-slate-950"> <i class="pr-2 fa-solid fa-tags"></i>CATALOGO</p>
</div>

<div class="flex p-4 my-4 border-2 bg-secondary">
  <div class="flex flex-col w-1/2 py-4">
    <p class="mb-2 font-bold text-center text-blue-700">Importar Produtos</p>
    <form class="flex flex-col items-center justify-items-center" action="{{ route('products_catalog.import')}}" method="post" enctype="multipart/form-data">
      @csrf
      <select class="mb-2 text-sm w-80" name="type">
        <option>Qual Tabela ?</option>
        <option  value="1">Catalogo</option>
        <option  value="2">ERP</option>
      </select>
      <input class="mb-2 text-sm w-90" type="file" name="file" required>
      <input type="submit" class="w-32 px-3 py-1 mt-4 font-semibold text-blue-700 bg-transparent border border-blue-500 rounded hover:bg-blue-500 hover:text-white hover:border-transparent" value="Enviar">
    </form>
    <p class="mt-4 text-xs text-center"><i class="mr-1 fa-solid fa-triangle-exclamation"></i>Enviar Arquivos .XLS para database!</p>
  </div>
  <div class="w-1/2 p-4">
    <p class="mb-2 font-medium uppercase text-slate-900-800">Instruções:</p>
      <p >1. Selecione para qual tabela será carregado os dados<p>
        <p>2. Selecione a planilha com os campos desejados<p>
        <p>3. Clique em <strong>ENVIAR</strong></p>
  </div>
</div>
<div class="flex flex-wrap">
  <div class="w-full">
    <form class="flex justify-center" action="{{ route('products.index')}}" method="post">
      @csrf
      <select class="" name="pesquisa">
        <option  value="search['NOERPSYNC']">Sem SKU ERP</option>
        <option  value="search['NOSYNC']">Não Sincronizados</option>
      </select>
      <input type="hidden" name="search" value="OK">
      <input type="submit" class="px-3 py-3 ml-2 font-semibold text-purple-800 bg-transparent border border-purple-600 rounded hover:bg-purple-500 hover:text-white hover:border-transparent" value="Consultar">
    </form>
  </div>
  <div class="flex justify-center w-full my-4">
    <a href="{{ route('products.readApi')}}" class="px-3 py-1 mt-4 mr-2 font-semibold text-purple-800 bg-transparent border border-purple-600 rounded hover:bg-purple-500 hover:text-white hover:border-transparent">Correlacionar com PLUGGTO</a>
    <a href="{{ route('products.force.sync')}}" class="px-3 py-1 mt-4 mr-2 font-semibold text-purple-800 bg-transparent border border-purple-600 rounded hover:bg-purple-500 hover:text-white hover:border-transparent">Reprocessar</a>
    <a href="{{ route('products.sync')}}" class="px-3 py-1 mt-4 font-semibold text-purple-800 bg-transparent border border-purple-600 rounded hover:bg-purple-500 hover:text-white hover:border-transparent">Correlacionar com GVM</a>
  </div>
</div>
<div class="flex p-4 text-white bg-blue-700 rounded">
  <span>SYNC: <strong>{{count($data)}}</strong> | NÃO SYNC: <strong> {{count($integration)}}</strong> | SKU ERP sem SKU: <strong> {{count($gvm)}}</strong> </span>
</div>
<!--table-->
<div class="">
  <table class="table w-full mt-1 space-y-6 text-sm">
    <thead class="text-purple-800 bg-transparent border border-purple-600">
      <tr class="">
        <th class="p-3 text-center" scope="col">#</th>
        <th class="p-3 text-left" scope="col">ID GVM</th>
        <th class="p-3 text-left" scope="col">SKU GVM</th>
        <th class="p-3 text-left" scope="col">SKU PLUGGTO</th>
        <th class="p-3 text-left" scope="col">PRODUTO</th>
      </tr>
    </thead>
    <tbody class="">
      @foreach($data as $product)
        <tr class="border-b-[1px] border-purple-600">
            <td class="p-3 text-center">{{ $product->id }}</td>
            <td class="p-3">{{ $product->id_gvm }}</td>
            <td class="p-3">{{ $product->sku_gvm }}</td>
            <td class="p-3">{{ $product->sku_pluggto }}</td>
            <td class="p-3">{{ $product->product_name }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection
