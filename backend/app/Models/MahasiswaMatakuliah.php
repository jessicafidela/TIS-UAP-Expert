<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MahasiswaMatakuliah extends Pivot
{
    protected $table = 'mahasiswa_matakuliah';

    public $incrementing = false; // karena composite pk
    public $timestamps = false;

    protected $primaryKey = null; // composite key, nggak pakai primary key
}