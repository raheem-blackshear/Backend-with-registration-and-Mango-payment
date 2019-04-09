@extends('admin.layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title">Dettagli Attività</h4>
          </div>
          <div class="card-body table-responsive">
            <div class="row">
              <div class="col-md-12">
                @if(session()->has('message'))
                  <div class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
                @endif
              </div>
            </div>
            <table class="table table-hover user_table">
              <tr>
                  <td>User Id</td>
                  <td>{{$merchant->user_id}}</td>
              </tr>
              <tr>
                  <td>Titolare</td>
                  <td>{{$merchant->titolare}}</td>
              </tr>
              <tr>
                  <td>Piva</td>
                  <td>{{$merchant->Piva}}</td>
              </tr>
              <tr>
                  <td>Codice Agente</td>
                  <td>{{$merchant->codice_agente}}</td>
              </tr>
              <tr>
                  <td>Email</td>
                  <td>{{$merchant->mail}}</td>
              </tr>
              <tr>
                  <td>Telefono Cellulare</td>
                  <td>{{$merchant->telefono_cellulare}}</td>
              </tr>
              <tr>
                  <td>Nomeattivita</td>
                  <td>{{$merchant->nomeattivita}}</td>
              </tr>
              <tr>
                  <td>Tipo Contratto</td>
                  <td>{{$merchant->tipo_contratto}}</td>
              </tr>
              <tr>
                  <td>Conferma</td>
                  <td>{{$merchant->Conferma}}</td>
              </tr>
              <!--<tr><td>Orario</td><td>{{$merchant->Orario}}</td></tr>-->
              <tr>
                  <td>Prezzo Minimo</td>
                  <td>{{$merchant->prezzo_minimo}}</td>
              </tr>
              <tr>
                  <td>Prezzo Massimo</td>
                  <td>{{$merchant->prezzo_massimo}}</td>
              </tr>
              <tr>
                  <td>Sconto Minimo</td>
                  <td>{{$merchant->sconto_minimo}}</td>
              </tr>
              <tr>
                  <td>Sconto Massimo</td>
                  <td>{{$merchant->sconto_massimo}}</td>
              </tr>
              <tr>
                  <td>Descrizione</td>
                  <td class="user_td">{{ wordwrap($merchant->descrizione, 50, "\n", TRUE) }}</td>
              </tr>
              <tr>
                  <td>Indirizzo</td>
                  <td>{{$merchant->indirizzo}}</td>
              </tr>
              <tr>
                  <td>Telefono Fisso</td>
                  <td>{{$merchant->telefono_fisso}}</td>
              </tr>
              <tr>
                  <td>Sito</td>
                  <td>{{$merchant->sito}}</td>
              </tr>
              <tr>
                  <td>Link Facebook</td>
                  <td>{{$merchant->link_facebook}}</td>
              </tr>
              <tr>
                  <td>Link Instagram</td>
                  <td>{{$merchant->link_instagram}}</td>
              </tr>
              <tr>
                  <td>Link Trip Advisor</td>
                  <td>{{$merchant->link_trip_advisor}}</td>
              </tr>
              <tr>
                  <td>Link Youtube</td>
                  <td>{{$merchant->link_youtube}}</td>
              </tr>
              <tr>
                  <td>Link Pinterest</td>
                  <td>{{$merchant->link_pinterest}}</td>
              </tr>
              <tr>
                  <td>Pagato</td>
                  <td>
                        @if($merchant->paid==1) 
                            Pagato 
                        @else 
                            Non Pagato 
                        @endif 
                  </td>
              </tr>
              <tr>
                  <td>Data Pagamento</td>
                  <td>{{$merchant->paid_time}}</td>
              </tr>
              <tr>
                  <td>Totale Pagamento</td>
                  <td>
                    {{$merchant->paid_amount}} 
                    @if($merchant->pain_amound) 
                        € 
                    @endif
                  </td>
              </tr>
            
              @if($cat)
                <tr><td>Categorie</td><td>{{ $cat->nome }}</td></tr>
              @endif
              @foreach($business_hours as $hour)
                <tr><td>{{ $day_list[$hour->giorno] }}</td><td>{{ $hour->open_time }} To {{ $hour->close_time }}</td></tr>
              @endforeach
            </table>
            <div style="text-align: center;"><p><strong>Images</strong></p></div>
            <div class="row">
                
                @if($images)
                    @foreach($images as $index => $image)
                        <div class="col-md-4">
                            <a href="{{ asset('img/merchant/'. $image->file_name) }}" target="_blank">
                                <img class="user_image" src="{{ asset('img/merchant/'. $image->file_name) }}" alt="img"/>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
