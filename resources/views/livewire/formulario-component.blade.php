<div>

    @if ($currentStep == 0 || $currentStep == 5)
        <style>
            body {
                background-image: url({{ asset('assets/fondo-azul.png') }});
            }

            .progress {
                display: none;
            }

        </style>
    @else
        <style>
            body {
                background-image: url({{ asset('assets/fondo-blanco.png') }});
            }

        </style>
    @endif

    <div class="progress">
        @switch($currentStep)
            @case(1)
                <div class="progress-bar bg-info" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0"
                    aria-valuemax="100"></div>
            @break

            @case(2)
                <div class="progress-bar bg-info" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0"
                    aria-valuemax="100"></div>
            @break

            @case(3)
                <div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                    aria-valuemax="100"></div>
            @break

            @default
        @endswitch
    </div>
    <br>
    <div class="row setup-content {{ $currentStep != 0 ? 'displayNone' : '' }}" id="step-0">
        <div class="col-xs-12">
            <div class="col-md-12" style="margin: 10%;">
                <img style="padding-bottom: 5%;" src="{{ asset('assets/logo-kavak.png') }}">
                <h1 class="text-white">Personaliza el</h1>
                <h1 class="text-white">jersey gigante</h1>
                <h1 class="text-white">con tu nombre</h1>
                <h1 class="text-white">y número</h1>
                <br>
                <div align="center" style="padding-top: 30px;">
                    <button class="btn btn-white nextBtn btn-lg pull-right text-dark" wire:click="enter"
                        type="button">Continuar</button>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h1 align="center">¡Hola!</h1>
                <h1 align="center">Ingresa tu nombre</h1>
                <div class="form-group" style="padding-top: 10%;">
                    <input type="text" wire:model="nombre" class="form-control" id="taskTitle">
                    @error('nombre')
                        <h5 class="text-danger">{{ $message }}</h5>
                    @enderror
                </div>
                <br>
                <div align="center" style="padding-top: 30px;">
                    <button class="btn btn-dark nextBtn btn-lg pull-right" wire:click="firstStepSubmit"
                        type="button">Continuar</button>
                    <br>
                    <img style="padding-top: 5%;" src="{{ asset('assets/logo-kavak-negro.png') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h1 align="center">Ahora ingresa tu</h1>
                <h1 align="center">número favorito</h1>
                <div class="form-group" style="padding-top: 10%;">
                    <input type="number" wire:model="numero" class="form-control" id="taskTitle">
                    @error('numero')
                        <h5 class="text-danger">{{ $message }}</h5>
                    @enderror
                </div>
                <br>
                <div align="center" style="padding-top: 30px;">
                    <button class="btn btn-dark nextBtn btn-lg pull-right" wire:click="back(1)"
                        type="button">Volver</button>
                    <button class="btn btn-dark nextBtn btn-lg pull-right" wire:click="secondStepSubmit"
                        type="button">Continuar</button>
                    <br>
                    <img style="padding-top: 5%;" src="{{ asset('assets/logo-kavak-negro.png') }}">
                </div>

                {{-- <button class="btn btn-primary nextBtn btn-lg pull-right" type="button"
                    wire:click="secondStepSubmit">Next</button> --}}
                {{-- <button class="btn btn-danger nextBtn btn-lg pull-right" type="button"
                    wire:click="back(1)">Back</button> --}}
            </div>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h1 align="center">¡Tu jersey está listo!</h1>
                <h6 align="center">Este es el diseño que aparecerá</h6>
                <h6 align="center">sobre el jersey gigante</h6>

                {{-- <div class="form-group" style="padding-top: 10%;">
                    <img style="justify-content: center;" src="{{ asset('assets/Kavak-jersey-SM.png') }}" alt="">
                </div> --}}
                <div style="display: flex; justify-content: center; align-items: center;">
                    <img style="justify-content: center;" src="{{ asset('assets/Kavak-jersey-SM.png') }}" alt="">
                </div>

                <div align="center" style="padding-top: 30px;">
                    <button class="btn btn-dark nextBtn btn-lg pull-right" wire:click="clearForm(1)"
                        type="button">Repetir</button>
                    <br><br>
                    <button class="btn btn-dark nextBtn btn-lg pull-right" wire:click="submitForm"
                        type="button">Continuar</button>
                    <br>
                    <img style="padding-top: 5%;" src="{{ asset('assets/logo-kavak-negro.png') }}">
                </div>

            </div>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 4 ? 'displayNone' : '' }}" id="step-4">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h1 align="center">¿Listo para ver</h1>
                <h1 align="center">tu jersey?</h1>

                <div style="display: flex; justify-content: center; align-items: center;" class="contenedor">
                    <img style="justify-content: center;" src="{{ asset('assets/Kavak-jersey-SM.png') }}" alt="">
                    <div class="centered">{{ $nombre }}</div>
                    <div class="numero">{{ $numero }}</div>
                </div>

                <div align="center" style="padding-top: 30px;">
                    <p>Tu jersey aparecerá en aproximadamente</p>
                    <p id="countdown"></p>
                    <div id="timer">
                        @if ($isPar)
                            <h5 class="text-primary">Vaya a la sala "A"</h5>
                            @if (!is_null($parAntes[0]->num))
                                <p>Hay: {{ $parAntes[0]->num }} antes de ti</p>
                            @endif
                        @else
                            <h5 class="text-primary">Vaya a la sala "B"</h5>
                            @if (isset($imParAntes[0]->num))
                                <p>Hay: {{ $imParAntes[0]->num }} antes de ti</p>
                            @endif
                        @endif
                    </div>
                    <img src="{{ asset('assets/logo-kavak-negro.png') }}">
                </div>
            </div>
        </div>
        <br>
    </div>
    <div class="row setup-content {{ $currentStep != 5 ? 'displayNone' : '' }}" id="step-5">
        <div class="col-xs-12">
            <div class="col-md-12" style="margin: 10%;">
                <h1 class="text-white">¡Pronto verás</h1>
                <h1 class="text-white">tu jersey!</h1>
                <br>
                <div align="center" style="padding-top: 30px;">
                    <button class="btn btn-white nextBtn btn-lg pull-right text-dark" wire:click="clearForm(1)"
                        type="button">Hacer otro jersey</button>
                    <br>
                    <img src="{{ asset('assets/logo-kavak.png') }}">
                </div>
            </div>
        </div>
    </div>
    <br>
</div>

<script>
    Livewire.emit('countdown');
    // Set the date we're counting down to
    var countDownDate = new Date("Jan 5, 2024 15:37:25").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("countdown").innerHTML = seconds + "s ";

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "EXPIRED";
        }
    }, 1000);
</script>
