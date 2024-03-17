<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Automobili extends Model
{
    protected $_automobili;
    protected $table = 'automobili';
    protected $primaryKey = 'promId';
    protected $fillable = ['nome', 'oggetto', 'modalità', 'tempi di fruizione', 'luoghi di fruizione'];

    public function getAutomobileById($id)
    {
        return $this->find($id);
    }

    public function getAutomobili($paged = 6, $order = null)
    {
        $query = Automobili::query();

        if (!is_null($order)) {
            $query->orderBy('nome', $order);
        }

        return $query->paginate($paged);
    }
    // Realazione One-To-One con Aziende
    public function promAz() {
        return $this->hasOne(Aziende::class, 'aziendeId', 'aziendeId');
    }
}
