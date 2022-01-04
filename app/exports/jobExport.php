<?php
namespace App\Exports;
use App\Models\Job;
use Maatwebsite\Excel\Concerns\FromCollection;
class JobExport implements FromCollection
{
  public function collection()
  {
    return Job::all();
  }
}