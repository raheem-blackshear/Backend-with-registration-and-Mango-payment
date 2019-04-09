@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registra nuova attività') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                @if(session()->has('message'))
                                    <div class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome e Cognome *') }}</label>

                            <div class="col-md-6">
                                <input id="nome_cognome" type="text" class="form-control{{ $errors->has('nome_cognome') ? ' is-invalid' : '' }}" name="nome_cognome" value="{{ old('nome_cognome') }}" required autofocus placeholder="Nome Cognome">

                                @if ($errors->has('nome_cognome'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nome_cognome') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Username *') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="email" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required placeholder="Email">

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password *') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password *') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>



                         <div class="form-group row">

                                <label for="titolare" class="col-md-4 col-form-label text-md-right">{{ __('Titolare *') }}</label>

                                <div class="col-md-6">

                                    <input id="titolare" type="text" class="form-control{{ $errors->has('titolare') ? ' is-invalid' : '' }}" name="titolare" value="{{ old('titolare') }}" required autofocus>



                                    @if ($errors->has('titolare'))

                                        <span class="invalid-feedback" role="alert">

                                            <strong>{{ $errors->first('titolare') }}</strong>

                                        </span>

                                    @endif

                                </div>

                            </div>



                            <div class="form-group row">

                                <label for="piva" class="col-md-4 col-form-label text-md-right">{{ __('Partita IVA') }}</label>



                                <div class="col-md-6">

                                    <input id="piva" type="number" class="form-control{{ $errors->has('piva') ? ' is-invalid' : '' }}" value="{{ old('piva') }}" name="piva">



                                    @if ($errors->has('piva'))

                                        <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('piva') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>



                            <div class="form-group row">

                                <label for="CodiceAgente" class="col-md-4 col-form-label text-md-right">{{ __('Codice Agente *') }}</label>



                                <div class="col-md-6">

                                    <input id="CodiceAgente" type="text" class="form-control{{ $errors->has('codice_agente') ? ' is-invalid' : '' }}" name="codice_agente" value="{{ old('codice_agente') }}" required>



                                    @if ($errors->has('codice_agente'))

                                        <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('codice_agente') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>



                            <div class="form-group row">

                                <label for="TelefonoCellulare" class="col-md-4 col-form-label text-md-right">{{ __('Telefono Cellulare *') }}</label>



                                <div class="col-md-6">

                                    <input id="TelefonoCellulare" type="text" class="form-control{{ $errors->has('codice_agente') ? ' is-invalid' : '' }}" name="telefono_cellulare" value="{{ old('telefono_cellulare') }}" required>

                                    @if ($errors->has('telefono_cellulare'))

                                        <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('telefono_cellulare') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>





                            <div class="form-group row">

                                <label for="Nomeattivita" class="col-md-4 col-form-label text-md-right">{{ __('Nome Attività *') }}</label>



                                <div class="col-md-6">

                                    <input id="Nomeattivita" type="text" class="form-control{{ $errors->has('nomeattivita') ? ' is-invalid' : '' }}" name="nomeattivita" value="{{ old('nomeattivita') }}" required>

                                    @if ($errors->has('nomeattivita'))

                                        <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('nomeattivita') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>



                            <div class="form-group row">

                                <label for="TipoContratto" class="col-md-4 col-form-label text-md-right">{{ __('Tipo Contratto *') }}</label>



                                <div class="col-md-6">

                                    <input id="TipoContratto" type="text" class="form-control{{ $errors->has('tipo_contratto') ? ' is-invalid' : '' }}" name="tipo_contratto" value="{{ old('tipo_contratto') }}" required>

                                    @if ($errors->has('tipo_contratto'))

                                        <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('tipo_contratto') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>





                            <div class="form-group row">

                                <label for="Conferma" class="col-md-4 col-form-label text-md-right">{{ __('Conferma') }}</label>



                                <div class="col-md-6">

                                    <select name="conferma" id="Conferma" class="form-control{{ $errors->has('conferma') ? ' is-invalid' : '' }}">

                                        <option value="1">interessato</option>

                                        <option value="2">non interessato</option>

                                        <option value="3">da chiudere</option>

                                    </select>

                                    @if ($errors->has('conferma'))

                                        <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('conferma') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registra') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
