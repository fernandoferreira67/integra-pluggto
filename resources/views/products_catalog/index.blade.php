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
      <input class="mb-2 text-sm w-90" type="file" name="file" required>
      <input type="submit" class="w-32 px-3 py-1 mt-4 font-semibold text-blue-700 bg-transparent border border-blue-500 rounded hover:bg-blue-500 hover:text-white hover:border-transparent" value="Enviar">
    </form>
    <p class="mt-4 text-xs text-center"><i class="mr-1 fa-solid fa-triangle-exclamation"></i>Enviar Arquivos .XLS para database!</p>
  </div>

  <div class="flex flex-col justify-center w-1/2 my-4">
    <a href="{{ route('products_catalog.exportAll')}}" class="px-3 py-1 mt-4 mr-2 font-semibold text-purple-800 bg-transparent border border-purple-600 rounded hover:bg-purple-500 hover:text-white hover:border-transparent">Export</a>
  </div>
</div>

<div class="flex p-4 my-4 border-2 bg-primary">
</div>

<!--table-->
<div class="">
  <table class="table w-full mt-1 space-y-6 text-sm">
    <thead class="text-purple-800 bg-transparent border border-purple-600">
      <tr class="">
        <th class="p-3 text-center" scope="col">#</th>
        <th class="p-3 text-left" scope="col">Nome</th>
        <th class="p-3 text-left" scope="col">SKU</th>
        <th class="p-3 text-left" scope="col">TIPO</th>
        <th class="p-3 text-left" scope="col">AÇÕES</th>
      </tr>
    </thead>
    <tbody class="">
      <form action="{{ route('products_catalog.export')}}" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
      @foreach($data as $product)
        <tr class="border-b-[1px] border-purple-600">
            <td class="p-3 text-center">
              <input type="checkbox" name="product_list[]" value="{{$product->id}}"> <label>{{$product->id}}</label>
            </td>
            <td class="p-3">{{ $product->product_name }}</td>
            <td class="p-3">{{ $product->sku }}</td>
            <td class="p-3">{{ $product->product_type }}</td>
            <td class="p-3">
              <a href="{{route('products_catalog.show',['id' => $product->id])}}">Ver</a>
            </td>
        </tr>
      @endforeach
      <input type="submit" class="px-3 py-1 mt-4 mr-2 font-semibold text-purple-800 bg-transparent border border-purple-600 rounded hover:bg-purple-500 hover:text-white hover:border-transparent"
      name="submit" value="Exportar Lista">
    </form>
    </tbody>

  </table>
</div>



@endsection
