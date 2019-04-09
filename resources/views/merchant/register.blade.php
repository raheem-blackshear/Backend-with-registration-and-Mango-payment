@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Completa la tua registrazione') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('final-registration') }}" enctype="multipart/form-data" id="submit_form">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    @if(session()->has('message'))
                                        <div class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
                                    @endif
                                </div>
                            </div>
                            
                            <input id="Orario" type="hidden" class="form-control" name="orario" value="">
                                
                            
                            <div class="form-group row">
                                <label for="PrezzoMinimo" class="col-md-4 col-form-label text-md-right">{{ __('Prezzo Minimo') }}</label>
                                <div class="col-md-6">
                                    <input id="PrezzoMinimo" type="number" class="form-control{{ $errors->has('prezzo_minimo') ? ' is-invalid' : '' }}" name="prezzo_minimo" value="{{ old('prezzo_minimo') }}">
                                    @if ($errors->has('prezzo_minimo'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('prezzo_minimo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="PrezzoMassimo" class="col-md-4 col-form-label text-md-right">{{ __('Prezzo Massimo') }}</label>
                                <div class="col-md-6">
                                    <input id="PrezzoMassimo" type="number" class="form-control{{ $errors->has('prezzo_massimo') ? ' is-invalid' : '' }}" name="prezzo_massimo" value="{{ old('prezzo_massimo') }}">
                                    @if ($errors->has('prezzo_massimo'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('prezzo_massimo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="ScontoMinimo" class="col-md-4 col-form-label text-md-right">{{ __('Sconto Minimo') }}</label>
                                <div class="col-md-6">
                                    <input id="ScontoMinimo" type="number" class="form-control{{ $errors->has('sconto_minimo') ? ' is-invalid' : '' }}" name="sconto_minimo" value="{{ old('sconto_minimo') }}">
                                    @if ($errors->has('sconto_minimo'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sconto_minimo') }}</strong>
                                        
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">

                                <label for="ScontoMassimo" class="col-md-4 col-form-label text-md-right">{{ __('Sconto Massimo') }}</label>



                                <div class="col-md-6">

                                    <input id="ScontoMassimo" type="number" class="form-control{{ $errors->has('sconto_massimo') ? ' is-invalid' : '' }}" name="sconto_massimo" value="{{ old('sconto_massimo') }}">

                                    @if ($errors->has('sconto_massimo'))
                                   
                                        <span class="invalid-feedback" role="alert">
                                            

                                        <strong>{{ $errors->first('sconto_massimo') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>





                            <div class="form-group row">

                                <label for="Descrizione" class="col-md-4 col-form-label text-md-right">{{ __('Descrizione') }}</label>



                                <div class="col-md-6">

                                    <textarea id="Descrizione" class="form-control{{ $errors->has('descrizione') ? ' is-invalid' : '' }}" name="descrizione">{{ old('descrizione') }}</textarea>

                                    @if ($errors->has('descrizione'))

                                        <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('descrizione') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>







                            <div class="form-group row">

                                <label for="Indirizzo" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo') }}</label>



                                <div class="col-md-6">

                                    <textarea id="Indirizzo" class="form-control{{ $errors->has('indirizzo') ? ' is-invalid' : '' }}" name="indirizzo">{{ old('indirizzo') }}</textarea>

                                    @if ($errors->has('indirizzo'))

                                        <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('indirizzo') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>







                            <div class="form-group row">

                                <label for="TelefonoFisso" class="col-md-4 col-form-label text-md-right">{{ __('Telefono Fisso') }}</label>



                                <div class="col-md-6">

                                    <input type="text" id="TelefonoFisso" class="form-control{{ $errors->has('telefono_fisso') ? ' is-invalid' : '' }}" name="telefono_fisso" value="{{ old('telefono_fisso') }}">

                                    @if ($errors->has('telefono_fisso'))

                                        <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('telefono_fisso') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>









                            <div class="form-group row">

                                <label for="Sito" class="col-md-4 col-form-label text-md-right">{{ __('Sito') }}</label>



                                <div class="col-md-6">

                                    <input id="Sito" type="text" class="form-control{{ $errors->has('sito') ? ' is-invalid' : '' }}" name="sito" value="{{ old('sito') }}">

                                    @if ($errors->has('sito'))

                                        <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('sito') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>







                            <div class="form-group row">

                                <label for="LinkFacebook" class="col-md-4 col-form-label text-md-right">{{ __('Link Facebook') }}</label>



                                <div class="col-md-6">

                                    <input id="LinkFacebook" type="text" class="form-control{{ $errors->has('link_facebook') ? ' is-invalid' : '' }}" name="link_facebook" value="{{ old('link_facebook') }}">

                                    @if ($errors->has('link_facebook'))

                                        <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('link_facebook') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>









                            <div class="form-group row">

                                <label for="LinkInstagram" class="col-md-4 col-form-label text-md-right">{{ __('Link Instagram') }}</label>



                                <div class="col-md-6">

                                    <input id="LinkInstagram" type="text" class="form-control{{ $errors->has('link_instagram') ? ' is-invalid' : '' }}" name="link_instagram" value="{{ old('link_instagram') }}">

                                    @if ($errors->has('link_instagram'))

                                        <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('link_instagram') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>









                            <div class="form-group row">

                                <label for="LinkTripAdvisor" class="col-md-4 col-form-label text-md-right">{{ __('Link TripAdvisor') }}</label>



                                <div class="col-md-6">

                                    <input id="LinkTripAdvisor" type="text" class="form-control{{ $errors->has('link_trip_advisor') ? ' is-invalid' : '' }}" name="link_trip_advisor" value="{{ old('link_trip_advisor') }}">

                                    @if ($errors->has('link_trip_advisor'))

                                        <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('link_trip_advisor') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>







                            <div class="form-group row">

                                <label for="LinkYouTube" class="col-md-4 col-form-label text-md-right">{{ __('Link YouTube') }}</label>



                                <div class="col-md-6">

                                    <input id="LinkYouTube" type="text" class="form-control{{ $errors->has('link_youtube') ? ' is-invalid' : '' }}" name="link_youtube" value="{{ old('link_youtube') }}">

                                    @if ($errors->has('link_youtube'))

                                        <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('link_youtube') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>









                            <div class="form-group row">

                                <label for="LinkPinterest" class="col-md-4 col-form-label text-md-right">{{ __('Link Pinterest') }}</label>



                                <div class="col-md-6">

                                    <input id="LinkPinterest" type="text" class="form-control{{ $errors->has('link_pinterest') ? ' is-invalid' : '' }}" name="link_pinterest" value="{{ old('link_pinterest') }}">

                                    @if ($errors->has('link_pinterest'))

                                        <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('link_pinterest') }}</strong>

                                    </span>

                                    @endif

                                </div>

                            </div>

                            <div class="form-group row">

                                <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Categorie') }}</label>



                                    <div class="col-md-6">

                                <select name="category" id="category" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->nome }}</option>
                                    @endforeach
                                </select>


                                </div>

                            </div>






                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Lunedì') }}</label>
                                <div class="col-md-3">
                                

                                    <select name="days[0][]" required="">
                                        <option value="">Orario di Apertura</option>
                                        @foreach($time as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="days[0][]" required="">
                                        <option value="">Orario di Chiusura</option>
                                        @foreach($time as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Martedì') }}</label>
                                <div class="col-md-3">
                                    <select name="days[1][]" required="">
                                        <option value="">Orario di Apertura</option>
                                        @foreach($time as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="days[1][]" required="">
                                        <option value="">Orario di Chiusura</option>
                                        @foreach($time as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="LinkPinterest" class="col-md-4 col-form-label text-md-right">{{ __('Mercoledì') }}</label>
                                <div class="col-md-3">
                                    <select name="days[2][]" required="">
                                        <option value="">Orario di Apertura</option>
                                        @foreach($time as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="days[2][]" required="">
                                        <option value="">Orario di Chiusura</option>
                                        @foreach($time as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="LinkPinterest" class="col-md-4 col-form-label text-md-right">{{ __('Giovedì') }}</label>
                                <div class="col-md-3">
                                    <select name="days[3][]" required="">
                                        <option value="">Orario di Apertura</option>
                                        @foreach($time as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="days[3][]" required="">
                                        <option value="">Orario di Chiusura</option>
                                        @foreach($time as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="LinkPinterest" class="col-md-4 col-form-label text-md-right">{{ __('Venerdì') }}</label>
                                <div class="col-md-3">

                                   <select name="days[4][]" required="">
                                        <option value="">Orario di Apertura</option>
                                        @foreach($time as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">

                                    <select name="days[4][]" required="">
                                        <option value="">Orario di Chiusura</option>
                                        @foreach($time as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="LinkPinterest" class="col-md-4 col-form-label text-md-right">{{ __('Sabato') }}</label>
                                <div class="col-md-3">

                                   <select name="days[5][]" required="">
                                        <option value="">Orario di Apertura</option>
                                        @foreach($time as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">

                                    <select name="days[5][]" required="">
                                        <option value="">Orario di Chiusura</option>
                                        @foreach($time as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="LinkPinterest" class="col-md-4 col-form-label text-md-right">{{ __('Domenica') }}</label>
                                <div class="col-md-3">

                                   <select name="days[6][]" required="">
                                        <option value="">Orario di Apertura</option>
                                        @foreach($time as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">

                                    <select name="days[6][]" required="">
                                        <option value="">Orario di Chiusura</option>
                                        @foreach($time as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row" >
                                <label for="LinkPinterest" class="col-md-4 col-form-label text-md-right">{{ __('Aggiungi immagini') }}</label>
                                <div class="col-md-8">
                                    <div class="input-group control-group">
                                        <input type="file" name="images[]" class="" multiple accept="image/*">
                                        @if (count($errors) > 0)
                                            <span class="invalid-feedback" role="alert" style="display:block;">
                                                <strong>Le immagini sono troppo pesanti, ridurle di qualità e riprovare</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <input type="hidden" name="email" value="{{ $user->username }}">

                            <input type="hidden" name="email_code" value="{{ $user->email_code }}">



                            <div class="form-group row mb-0">

                                <div class="col-md-6 offset-md-4">

                                    <button type="submit" class="btn btn-primary" id="submit_button">

                                        {{ __('Completa Registrazione') }}

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