<?php

namespace App\Imports;

use App\Models\Serti;
use App\Models\Serti_list;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ListImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    // protected $serti_id = null;
    public function collection(Collection $rows)
    {
        $serti_id = request('serti_id');
        foreach ($rows as $row) 
        {
            $data = [
                'serti_id'     => $serti_id,
                'no_urut'     => $row['no_urut'],
                'nip'     => $row['nip'],
                'nama'    => $row['nama'], 
            ];
            $cek = Serti_list::where('serti_id', $serti_id)->where('nip', $row['nip'])->get();
            if($cek->count()==0){
                Serti_list::create($data);
            }else{
                Serti_list::where('serti_id', $serti_id)->where('nip', $row['nip'])->update($data);
            }
        }
    }
}
