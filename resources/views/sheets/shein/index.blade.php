@extends('layouts.app')

@section('content')
<div class="flex justify-center">
  <img src="{{ Vite::asset('resources/images/shein-logo.png')}}" class="w-40 mt-6" alt="">
</div>

<div class="flex items-center justify-center">
  <div class="flex flex-col p-4 my-4 border-2 bg-secondary">
    <p class="mb-2 font-bold text-center text-gray-950 uppercase">Importar Produtos</p>
    <form class="flex flex-col items-center justify-items-center" action="{{ route('shein.import')}}" method="post" enctype="multipart/form-data">
      @csrf
      <input type="file" class="mt-2 text-sm w-90" name="file" required>
      <p class="mt-4 text-xs text-center"><i class="mr-1 fa-solid fa-triangle-exclamation"></i>Tipo de Arquivo: .XLS .CSV</p>
      <input type="submit" class="w-32 px-3 py-1 mt-4 font-semibold text-gray-950 bg-transparent border border-gray-950 rounded hover:bg-black hover:text-white hover:border-transparent" value="Enviar">
    </form>
  </div>
</div>

<div class="flex justify-center w-full my-4">
  <a href="{{ route('shein.interconnection')}}" class="px-3 py-1 mt-4 mr-2 font-semibold text-gray-950 bg-transparent border border-gray-950 rounded hover:bg-black hover:text-white hover:border-transparent"><i class="mr-2 fa-solid fa-link"></i>Correlacionar</a>
  <a href="{{ route('shein.export')}}" class="px-3 py-1 mt-4 mr-2 font-semibold text-gray-950 bg-transparent border border-gray-950 rounded hover:bg-black hover:text-white hover:border-transparent"><i class="mr-2 fa-solid fa-file-export"></i>Exporta Arquivo</a>
  <a href="{{ route('shein.newDatabase')}}" class="px-3 py-1 mt-4 mr-2 font-semibold text-gray-950 bg-transparent border border-gray-950 rounded hover:bg-black hover:text-white hover:border-transparent"><i class="mr-2 fa-solid fa-trash-can"></i>Limpar Database</a>

  <form action="{{route('shein.force.sync')}}" method="post">
    @csrf
    <input type="hidden" name="force" value="OK">
    <button type="submit" class="px-3 py-1 mt-4 mr-2 font-semibold text-gray-950 bg-transparent border border-gray-950 rounded hover:bg-black hover:text-white hover:border-transparent"><i class="mr-2 fa-solid fa-link-slash"></i>Reprocessar</button>
  </form>
</div>
<div class="flex justify-center w-full my-4">
  <form action="{{route('shein.index.search')}}" method="post" class="my-2">
    @csrf
    <input type="hidden" name="search" value="*">
    <button type="submit" class="px-3 py-1 font-semibold text-gray-950 bg-transparent border border-gray-950 rounded hover:bg-black hover:text-white hover:border-transparent"><i class="mr-2 fa-solid fa-magnifying-glass"></i>Consultar Não Correlacionados</button>
  </form>
</div>



<div class="my-5 container-auto">
  <table class="table w-full mt-1 space-y-6 text-sm">
    <thead class="text-gray-950 bg-transparent border border-gray-950">
      <tr>
        <th class="p-3 text-center" scope="col">Plugg.to SKU</th>
        <th class="p-3 text-center" scope="col">Marketplace SKU</th>
        <th class="p-3 text-center" scope="col">Marketplace Parent SKU</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $product)
        <tr class="border-b-[1px] border-orange-100">
          <td class="py-1 text-center">{{ $product->pluggto_sku }}</td>
          <td class="py-1 text-center">{{ $product->marketplace_sku}}</td>
          <td class="py-1 text-center">{{ $product->marketplace_parent_sku}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection
