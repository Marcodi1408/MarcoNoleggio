<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aziende;
use App\Models\Automobili;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


class StaffController extends Controller
{

    public function create($aziendeId)
    {
        $azienda = Aziende::find($aziendeId);
        return view('aggiunta_promozione')
            ->with('azienda',$azienda);
    }

    public function storePromozione(Request $request, $aziendeId)
    {

        $oggi = Carbon::now()->format('Y-m-d');
        // Validazione dei dati inseriti nel form
        $validatedData = $request->validate([
            'nome' => 'required|string|max:35',
            'oggetto' => 'required|string|max:50',
            'modalita' => 'required|string|max:2500',
            'luoghi_fruizione' => 'required|string|max:30',
            'tempi_fruizione' => 'required|date|after_or_equal:'.$oggi,
        ]);

        // Salvataggio della promozione nel database
        $automobile= new Automobili\();
        $automobile->nome = $validatedData['nome'];
        $automobile->oggetto = $validatedData['oggetto'];
        $automobile->modalita = $validatedData['modalita'];
        $automobile->aziendeId = $aziendeId;
        $automobile->luoghi_fruizione = $validatedData['luoghi_fruizione'];
        $automobile->tempi_fruizione = $validatedData['tempi_fruizione'];


        $automobile->save();

        // Reindirizzamento o altra azione dopo il salvataggio dell'promozione
        return redirect()->route('home');
    }

    public function destroy($promId)
    {
        // Trova l'promozione da eliminare
        $automobile = Automobili\::findOrFail($promId);

            // Elimina l'promozione
            $promozione->delete();

            // Esegui eventuali altre azioni o reindirizzamenti

            // Ad esempio, puoi reindirizzare l'utente a una pagina di conferma
            return redirect()->route('home');
        }

    public function show($userId)
    {
        $user = User::findOrFail($userId);
        return view('staffpage', compact('user'));
    }

    public function lista()
    {
        $user = User::where('role', 'staff')->get();
        return view('elenco_staff', ['users' => $user]);
    }

    public function show1($promId) {
        $automobile = Automobili\::find($promId);

            if (!$automobile) {
                abort(404);
            }

            return view('pagina_modifica_promozione', compact('automobile'));
            }

    public function update(Request $request, $promId)
    {
        $oggi = Carbon::now()->format('Y-m-d');

        $request->validate([
            'nome' => ['required', 'string', 'max:35'],
            'oggetto' => ['required', 'string', 'max:50'],
            'modalita' => ['required', 'string', 'max:2500'],
            'luoghi_fruizione' => ['required', 'string', 'max:30'],
            'tempi_fruizione' => ['required', 'string', 'after_or_equal:'.$oggi],
        ]);

        $automobile = Automobili\::find($promId);

        $automobile->nome = $request['nome'];
        $automobile->oggetto = $request['oggetto'];
        $automobile->modalita = $request['modalita'];
        $automobile->luoghi_fruizione = $request['luoghi_fruizione'];
        $automobile->tempi_fruizione = $request['tempi_fruizione'];
        $automobile->update();

        return redirect()->route('home');
    }

    public function showStaff($userId) {
        $user = User::find($userId);

        if (!$user) {
            abort(404);
        }

        return view('pagina_modifica_staff', compact('user'));
    }


    public function updateStaff(Request $request, $userId)
    {

        $user = User::find($userId);


        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'surname' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);


        $user->name = $request->name;
        $user->surname = $request->surname;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->update();

        return redirect()->route('home');
    }


}
