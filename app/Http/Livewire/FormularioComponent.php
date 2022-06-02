<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Camiseta;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FormularioComponent extends Component
{
    use LivewireAlert;

    public $currentStep = 0;
    public $nombre, $numero;
    public $successMessage = '';
    public $ultimoID, $isPar, $parAntes = 0, $imParAntes;

    protected $listeners = ['countdown' => 'finishPage'];

    public function finishPage()
    {
        dd('finish');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function render()
    {
        return view('livewire.formulario-component');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function firstStepSubmit()
    {
        $validatedData = $this->validate(
            [
                'nombre' => 'required',
            ],
            [
                'nombre.required' => 'El campo nombre es obligatorio.',
            ],
        );

        $this->currentStep = 2;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function secondStepSubmit()
    {
        $validatedData = $this->validate(
            [
                'numero' => 'required',
            ],
            [
                'numero.required' => 'El campo número es obligatorio.',
            ],
        );

        $this->currentStep = 3;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitForm()
    {
        Camiseta::create([
            'nombre' => $this->nombre,
            'numero' => $this->numero,
        ]);

        $this->currentStep = 4;

        $this->ultimoID = Camiseta::latest()->first()->id;

        $this->isPar = $this->ultimoID % 2 == 0;

        $this->parAntes = DB::select("SELECT count(*) as num FROM camisetas WHERE MOD (id, 2) = 1 AND id < $this->ultimoID ORDER BY id ASC;");

        $this->imParAntes = DB::select("SELECT count(*) as num FROM camisetas WHERE MOD (id, 2) = 0 AND id < $this->ultimoID ORDER BY id ASC;");
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function enter()
    {
        $this->currentStep = 1;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function clearForm($step)
    {
        $this->currentStep = $step;
        $this->nombre = '';
        $this->numero = '';
        $this->stock = '';
        $this->status = 1;
        $this->alerta('Formulario reiniciado');
    }

    public function alerta($message)
    {
        $this->alert('success', $message, [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }
}
