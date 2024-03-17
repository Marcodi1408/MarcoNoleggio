<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\SoftDeletes;

class Aziende extends Model
{
    protected $_aziende;
    protected $table = 'aziende';
    protected $primaryKey = 'aziendeId';

    public function getAziende($paged = 4,$order=null)
    {
        $query = Aziende::query();

        if (!is_null($order)) {
            $query->orderBy('name', $order);
        }

        return $query->paginate($paged);
    }

    public function getAziendaPaged($id)
    {
        return $this->_aziende->firstWhere('azId', $id);
    }

    protected $fillable = [
        'name',
        'tipologia',
        'desc',
        'citta',
        'via',
        'cap',
        'image',
    ];

}
