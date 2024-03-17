<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Automobili;
use App\Models\Aziende;


class PublicController extends Controller
{
    protected $_aziende;
    protected $_automobili;

    public function __construct()
    {
        $this->_aziende = new Aziende;
        $this->_automobili = new Automobili;
    }
    public function index()
    {
        $topAziende = $this->_aziende->getAziende();
        $topAutomobili = $this->_automobili->getAutomobili();

        return view('home')
            ->with('aziende', $topAziende)
            ->with('automobili', $topAutomobili);
    }


    public function listaAziende()
    {
        $listaAziende = $this->_aziende->getAziende();

        return view('lista_aziende')
            ->with('aziende',$listaAziende);
    }

    public function listaAutomobili()
    {
        $listaAutomobili = $this->_automobili->getAutomobili();

        return view('lista_automobili')
            ->with('automobili', $listaAutomobili);
    }

}
