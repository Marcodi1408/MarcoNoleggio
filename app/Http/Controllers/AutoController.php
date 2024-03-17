<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Coupon;
use App\Models\Automobili;

use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class AutoController extends Controller
{

    public function show($couponId)
    {
        // Ottenere il coupon dal suo ID
        $coupon = Coupon::find($couponId);

        if (!$coupon) {
            // Il coupon non è stato trovato, puoi gestire questa situazione come preferisci
            return abort(404);
        }

        // Passa il coupon alla vista del coupon per visualizzarlo
        return view('coupon', compact('coupon'));
    }


    public function store($promozioneId)
    {
        // Recupera l'ID dell'utente autenticato
        $userId = Auth::id();


        // Controlla se l'utente ha già acquisito un coupon per la promozione corrente
        $existingCoupon = Coupon::where('userId', $userId)
            ->where('promId', $promozioneId)
            ->first();

        if ($existingCoupon) {
            // L'utente ha già acquisito un coupon per questa promozione, visualizza il messaggio di avviso
            return redirect()->route('home')->with('couponExists', true);
        }

        $automobile = Automobili\::find($promozioneId);

    $dataScadenza = Carbon::createFromFormat('Y-m-d',$automobile->tempi_fruizione);
    //$dataOdierna = strtotime(date('Y-m-d'));
    $dataOggi = Carbon::now();

  /*  $dataScadenza = strtotime($promozione->data_scadenza);
    $dataOdierna = strtotime(date('Y-m-d')); */

    if ($dataOggi->gt($dataScadenza) ) {
        // La promozione è scaduta, mostra un messaggio all'utente
        return redirect()->route('home')->with('promScaduta', true);
    }



    // Genera un codice unico per il coupon
    $codiceCoupon = $this->generaCodiceUnico();

    // Crea il nuovo coupon
    $coupon = new Coupon();
    $coupon->codice = $codiceCoupon;
    $coupon->promId = $promozioneId;
    $coupon->userId = $userId;
    $coupon->save();

    // Incrementa il contatore "coupon" dell'utente
    $user = Auth::user();
    $user->increment('coupon');

    // Incrementa il contatore "numeroCoupon" della promozione

    $promozione->increment('numeroCoupon');

    return redirect()->route('coupon.show', ['couponId' => $coupon->couponId]);

    }




    protected function generaCodiceUnico()
    {
        $codiceCoupon = Str::random(6);

        // Verifica se il codice esiste già nella tabella "coupon"
        $codiceEsistente = Coupon::where('codice', $codiceCoupon)->exists();

        // Se il codice esiste già, genera un nuovo codice unico
        $tentativi = 1;
        while ($codiceEsistente) {
            $codiceCoupon = Str::random(6);
            $codiceEsistente = Coupon::where('codice', $codiceCoupon)->exists();

            // Limita il numero di tentativi per generare un codice unico
            $tentativi++;
            if ($tentativi > 100) {
                // dopo 100 tentativi il codice ritorna null, anche se è improbabile
                // che ci vogliano piu di 100 tentativi per generare un codice non doppione
                return null;
            }
        }

        return $codiceCoupon;
    }


}
