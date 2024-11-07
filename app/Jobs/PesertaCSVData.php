<?php

namespace App\Jobs;

use App\Models\Serti_list;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PesertaCSVData
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;
  
    public $header;
    public $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data, $header)
    {
        $this->data = $data;
        $this->header = $header;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->data as $peserta) {
            $pesertaInput = array_combine($this->header, $peserta);
            Serti_list::create($pesertaInput);
        }
    }
}
