@extends('layouts.app')

@section('content')
<div class="flex justify-center">
  <img src="{{ Vite::asset('resources/images/b2w-logo.png')}}" class="w-40 mt-6" alt="">
</div>

<div class="flex items-center justify-center">
  <div class="flex flex-col p-4 my-4 border-2 bg-secondary">
    <p class="mb-2 font-bold text-center text-teal-500 uppercase">Importar Produtos</p>
    <form action="{{ route('b2w.import')}}" method="post" class="flex flex-col items-center justify-items-center" enctype="multipart/form-data">
      @csrf
      <input type="file" class="mt-2 text-sm w-90" name="file" required>
      <p class="mt-4 text-xs text-center"><i class="mr-1 fa-solid fa-triangle-exclamation"></i>Tipo de Arquivo: .XLS .CSV</p>
      <input type="submit" class="w-32 px-3 py-1 mt-4 font-semibold text-teal-500 bg-transparent border border-teal-500 rounded hover:bg-teal-500 hover:text-white hover:border-transparent" value="Enviar">
    </form>
  </div>
</div>

<div class="flex justify-center w-full my-4">
  <a href="{{ route('b2w.interconnection')}}" class="px-3 py-1 mt-4 mr-2 font-semibold text-teal-500 bg-transparent border border-teal-500 rounded hover:bg-teal-500 hover:text-white hover:border-transparent"><i class="mr-2 fa-solid fa-link"></i>Correlacionar</a>

  <a href="{{ route('b2w.newDatabase')}}" class="px-3 py-1 mt-4 mr-2 font-semibold text-teal-500 bg-transparent border border-teal-500 rounded hover:bg-teal-500 hover:text-white hover:border-transparent"><i class="mr-2 fa-solid fa-trash-can"></i>Limpar Database</a>

  <form action="{{ route('b2w.export')}}" method="post">
    @csrf
    <select class="" name="option">
      <option value="SYNC">Pronto</option>
      <option value="INACTIVE">Inativo</option>
    </select>
    <button type="submit" class="px-3 py-1 mt-4 mr-2 font-semibold text-teal-500 bg-transparent border border-teal-500 rounded hover:bg-teal-500 hover:text-white hover:border-transparent"><i class="mr-2 fa-solid fa-link-slash"></i>Exporta Arquivo</button>
  </form>


  <form action="{{ route('b2w.force.sync')}}" method="post">
    @csrf
    <input type="hidden" name="force" value="OK">
    <button type="submit" class="px-3 py-1 mt-4 mr-2 font-semibold text-teal-500 bg-transparent border border-teal-500 rounded hover:bg-teal-500 hover:text-white hover:border-transparent"><i class="mr-2 fa-solid fa-link-slash"></i>Reprocessar</button>
  </form>
</div>
<div class="flex justify-center w-full my-4">
  <form action="{{ route('b2w.index.search')}}" method="post" class="my-2">
    @csrf
    <input type="hidden" name="search" value="*">
    <button type="submit" class="px-3 py-1 font-semibold text-teal-500 bg-transparent border border-teal-500 rounded hover:bg-teal-500 hover:text-white hover:border-transparent"><i class="mr-2 fa-solid fa-magnifying-glass"></i>Consultar Não Correlacionados</button>
  </form>
</div>

<div class="flex p-4 text-white bg-teal-700 rounded">
  <span>TOTAL: <strong>{{$filter['all']}}</strong> | SKU SEM CORRELAÇÃO: <strong>{{$filter['not_search']}}</strong> | SKU Sincronizados: <strong> {{$filter['sync']}}</strong> | Aguardando Sincronização: <strong> {{$filter['waiting']}}</strong> </span>
</div>

<div class="my-5 container-auto">
  <table class="table w-full mt-1 space-y-6 text-sm">
    <thead class="text-teal-500 bg-transparent border border-teal-500">
      <tr>
        <th class="p-3 text-center" scope="col">SKU PLUGG.TO</th>
        <th class="p-3 text-center" scope="col">SKU MARKETPLACE</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $product)
        <tr class="border-b-[1px] border-blue-100">
          <td class="py-1 text-center">{{ $product->pluggto_sku }}</td>
          <td class="py-1 text-center">{{ $product->sku }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
