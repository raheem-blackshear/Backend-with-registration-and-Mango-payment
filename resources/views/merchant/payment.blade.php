@extends('layouts.app')



@section('content')

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">{{ __('Opzioni di Pagamento') }}</div>



                    <div class="card-body"><p>




    <div class="row">
    
        <div class="col-md-12">
        
            @if(session()->has('message'))
        
                <div class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
        
            @endif
        
        </div>
    
    </div>


<label>Full Name: </label>

<label> {{ session()->get('first_name') }} </label>

<div class="clear"></div>


<label style="text-align: center;"><strong> Prezzo : {{ session()->get('amount')/100 }}, {{ session()->get('currency') }}</strong></label>

<div class="clear"></div>


<form action="{{ session()->get('CardRegistrationURL') }}" method="post">
    
    

    <input type="hidden" name="data" value="{{ session()->get('PreregistrationData') }}" />

    <input type="hidden" name="accessKeyRef" value="{{ session()->get('AccessKey') }}" />

    <input type="hidden" name="returnURL" value="{{ session()->get('returnUrl') }}" />

<div class="row">
    
    <div class="col-md-4">
        <label for="cardNumber">Nº Carta di Credito :</label>
    </div>
    <div class="col-md-8">
        <input type="text" name="cardNumber" value="" class="form-control" placeholder="123456789012" required/>

        <div class="clear"></div><br>
    </div>
</div>


<div class="row">
    
    <div class="col-md-4">
        <label for="cardExpirationDate">Data di Scadenza Carta di Credito :</label>
    </div>
    <div class="col-md-8">
        <input type="text" name="cardExpirationDate" value="" class="form-control" placeholder="1221" required/>
        <span style="color: #c61a1a;">Nota*: Inserisci mese e anno senza spazio o carattere</span>
        <div class="clear"></div><br>
    </div>
</div>


<div class="row">
    
    <div class="col-md-4">
         <label for="cardCvx">CVV</label>
    </div>
    <div class="col-md-8">
        <input type="text" name="cardCvx" value="" class="form-control" placeholder="123" required />

    <div class="clear"></div><br>

    </div>
</div>
    



  

    



    

    <div class="row">
        <div class="col-md-4"><input type="submit" value="Avvia il Pagamento" class="btn btn-success"/></div>
    </div>

</form>


                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection