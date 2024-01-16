<?php

namespace App\Exports;

use App\Models\B2W;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Str;

class B2WExport implements FromCollection, WithHeadings, WithMapping
{
    protected $option;

    function __construct($option) {
      $this->option = $option;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      if($this->option == 'SYNC'){
        return B2W::where('sync', 'OK')->get();
      }elseif($this->option == 'INACTIVE'){
        return B2W::where('sync', 'N')->get();
      }
    }

    public function headings():array {

      if($this->option == 'SYNC'){
      return [
          'pluggto_sku',
          'b2w_sku',
        ];
      }elseif($this->option == 'INACTIVE'){
        return [
          'SKU',
        ];
      }
    }

  public function map($line):array {

    if($this->option == 'SYNC'){

      return [
        $line->pluggto_sku,
        $line->sku,
      ];

    }elseif($this->option == 'INACTIVE'){

      return [
        Str::replace('*', '', $line->sku),
      ];

    }
  }
}
