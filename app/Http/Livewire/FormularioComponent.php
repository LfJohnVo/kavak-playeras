<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Camiseta;
use Illuminate\Support\Str;
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
        $string = app('profanityFilter')->replaceWith('#')->replaceFullWords(true)->filter($this->nombre);

        if (Str::contains($string, '#')) {
            $this->alerta('error', 'El nombre no puede contener palabras ofensivas');
            $this->nombre = $string;
        } else {
            $validatedData = $this->validate(
                [
                    'nombre' => 'required|profanity|max:8',
                ],
                [
                    'nombre.required' => 'El campo no puede estar vacío.',
                ],
                [
                    'nombre.max' => 'El campo puede tener hasta 8 caracteres.',
                ],
            );

            $this->currentStep = 2;
        }
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
                'numero' => 'required|max:2',
            ],
            [
                'numero.required' => 'El campo número es obligatorio.',
            ],
            [
                'numero.max' => 'El campo puede tener hasta 8 caracteres.',
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

        $this->ultimoID = Camiseta::latest()->first()->id;

        $this->isPar = $this->ultimoID % 2 == 0;

        $this->parAntes = DB::select("SELECT count(*) as num FROM camisetas WHERE MOD (id, 2) = 0 AND id < $this->ultimoID ORDER BY id ASC;");

        $this->imParAntes = DB::select("SELECT count(*) as num FROM camisetas WHERE MOD (id, 2) = 1 AND id < $this->ultimoID ORDER BY id ASC;");

        $this->currentStep = 4;

        $this->dispatchBrowserEvent('TerminaJersey');
    }

    public function finishPage()
    {
        $this->currentStep = 5;
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
        $this->alerta('success', 'Formulario reiniciado');
    }

    public function alerta($type, $message)
    {
        $this->alert($type, $message, [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }
}
