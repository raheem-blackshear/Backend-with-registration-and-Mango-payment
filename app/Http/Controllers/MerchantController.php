<?php

namespace App\Http\Controllers;

use App\Contract;
use App\User;
use App\Categorie;
use App\ContractCategorie;
use App\BusinessHours;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use MangoPay\CardRegistration;
use MangoPay\Libraries\ResponseException;
use MangoPay\MangoPayApi;
use MangoPay\Money;
use MangoPay\PayIn;
use MangoPay\PayInExecutionDetailsDirect;
use MangoPay\PayInExecutionDetailsWeb;
use MangoPay\PayInPaymentDetailsCard;
use MangoPay\UserNatural;
use MangoPay\Wallet;
use App\MerchantImage;

class MerchantController extends Controller
{

    private $mangoPayApi;
    private $legalUserId;
    private $legalUserWalletId;
    private $bankIBAN;
    private $bankBCI;
    private $bankOwnerName;
    private $bankOwnerAddress;
    
    public function __construct(){

        $this->mangoPayApi = new MangoPayApi();
        $this->mangoPayApi->Config->ClientId = '01382f45946up';
        $this->mangoPayApi->Config->ClientPassword = 'N8wYpTr4cLsaPxeNBzUX3tgkvrnD8n7sjqBo4JPoogZNhqZDYn';
        $this->mangoPayApi->Config->TemporaryFolder = storage_path().'/temp/';
        
        $this->legalUserId = "63717465";
        $this->legalUserWalletId = "63717475";
        
        //uncomment this to use the production environment
        //$this->mangoPayApi->Config->BaseUrl = 'https://api.mangopay.com';

    }

    public function index(){
        return view('auth.register');
    }


    public function home(){
        return view('welcome');
    }


    public function thankYou(){
        return view('home');
    }

    public function register(Request $request){
        $request->validate([
            'nome_cognome' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'titolare' => ['required', 'string', 'max:250'],
            'codice_agente' => ['required', 'string', 'max:10'],
            'telefono_cellulare' => ['required', 'string', 'max:30'],
            'nomeattivita' => ['required', 'string', 'max:100'],
            'tipo_contratto' => ['required', 'string', 'max:100'],
            'conferma' => ['required', 'numeric', 'max:3'],
        ]);

        $nome_cognome = $request->get('nome_cognome');
        $username = $request->get('username');
        $password = $request->get('password');
        $user = User::create([
            'nome_cognome' => $nome_cognome,
            'username' => $username,
            'password' => Hash::make($password),
            'isAdmin' => 0,
        ]);
        $contract = new Contract();
        $contract->user_id = $user->id;
        $contract->titolare = $request->get('titolare');
        $contract->piva = $request->get('piva');
        $contract->codice_agente = $request->get('codice_agente');
        $contract->mail = $user->username;
        $contract->telefono_cellulare = $request->get('telefono_cellulare');
        $contract->nomeattivita = $request->get('nomeattivita');
        $contract->tipo_contratto = $request->get('tipo_contratto');
        $contract->conferma = $request->get('conferma');
        $contract->created_at = Carbon::now();

        $contract->save();
        if(!$user){
            Session::flash('message', 'Problem, Please Try Again Letter');
            Session::flash('alert-class', 'alert-danger');
        }
        // Session::flash('message', 'Registration Successful, We will send you an email to complete your registration and we will need to wait approval from admin side');
        Session::flash('message', 'Registrazione avvenuta con successo, l\'attività riceverà una mail ad avvenuta approvazione');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('thankyou');
    }

    public function finalForm($code){
        if(empty($code)){
            Session::flash('message', 'Empty Code');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/');
        }
        $user = User::where('email_code', $code)->first();
        if(!$user){
            Session::flash('message', 'User Not Found');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/');
        }

        $categories = Categorie::all();


        if(empty($user)){
            Session::flash('message', 'No User Found');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/');
        }
        $time = array(
            'closed' => 'Closed',
            '10:00 AM' => '10:00 AM',
            '11:00 AM' => '11:00 AM',
            '12:00 PM' => '12:00 PM',
            '01:00 PM' => '01:00 PM',
            '02:00 PM' => '02:00 PM',
            '03:00 PM' => '03:00 PM',
            '04:00 PM' => '04:00 PM',
            '05:00 PM' => '05:00 PM',
            '06:00 PM' => '06:00 PM',
            '07:00 PM' => '07:00 PM',
            '08:00 PM' => '08:00 PM',
            '09:00 PM' => '09:00 PM',
            '10:00 PM' => '10:00 PM',
            '11:00 PM' => '11:00 PM',
            '12:00 PM' => '12:00 PM',
            '01:00 AM' => '01:00 AM',
            '02:00 AM' => '02:00 AM',
            '03:00 AM' => '03:00 AM',
            '04:00 AM' => '04:00 AM',
            '05:00 AM' => '05:00 AM',
            '06:00 AM' => '06:00 AM',
            '07:00 AM' => '07:00 AM',
            '08:00 AM' => '08:00 AM',
            '09:00 AM' => '09:00 AM',
        );
        return view('merchant.register', compact('user', 'categories', 'time'));
    }


    public function finalRegistration(Request $request){
        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg|max:1024',
        ]);
        $prezzo_minimo = $request->get('prezzo_minimo');
        $prezzo_massimo = $request->get('prezzo_massimo');
        $sconto_minimo = $request->get('sconto_minimo');
        $sconto_massimo = $request->get('sconto_massimo');
        
        if($prezzo_massimo < $prezzo_minimo){
            Session::flash('message', 'Prezzo Minimo cannot be greater than Prezzo Massimo');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
        if($sconto_massimo < $sconto_minimo){
            Session::flash('message', 'Sconto Minimo cannot be greater than Sconto Massimo');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
        
        $user = User::whereUsername($request->get('email'))->first();
        

        $contract = Contract::whereUserId($user->id)->first();

        $contract->orario = $request->get('orario');
        $contract->prezzo_minimo = $request->get('prezzo_minimo');
        $contract->prezzo_massimo = $request->get('prezzo_massimo');
        $contract->sconto_minimo = $request->get('sconto_minimo');
        $contract->sconto_massimo = $request->get('sconto_massimo');
        $contract->descrizione = $request->get('descrizione');
        $contract->indirizzo = $request->get('indirizzo');
        $contract->telefono_fisso = $request->get('telefono_fisso');
        $contract->sito = $request->get('sito');
        $contract->link_facebook = $request->get('link_facebook');
        $contract->link_instagram = $request->get('link_instagram');
        $contract->link_trip_advisor = $request->get('link_trip_advisor');
        $contract->link_youtube = $request->get('link_youtube');
        $contract->link_pinterest = $request->get('link_pinterest');
        $contract->created_at = Carbon::now();


        $con_cat = new ContractCategorie();

        $con_cat->id_contract = $user->id;
        $con_cat->id_categoria = $request->get('category');
       

        if($user->email_code != $request->get('email_code')){
            Session::flash('message', 'User not found');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }


        if($images=$request->file('images'))
        {
            foreach($images as $image)
            {
                $name = time().$image->getClientOriginalName();
                $image->move('img/merchant/', $name);  
                // $data[] = $name;  
                
                $merchant_images= new MerchantImage();
                $merchant_images->user_id = $user->id;
                $merchant_images->file_name=$name;
                
                $merchant_images->save();
                
            }
        }
       
        
        $days = $request->get('days');

        foreach($days as $key => $value){
            $business_hour = new BusinessHours();
            $business_hour->id_contract = $user->id;
            $business_hour->giorno = $key;
            $business_hour->open_time = $value[0];
            $business_hour->close_time = $value[1];
            $business_hour->save();
        }
        

        
        $con_cat->save();
        $saved = $contract->save();
        
        if(!$saved){
            Session::flash('message', 'We are facing problems, Please try after some time');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
        
        
        
        $user->email_code = md5(time());
        $user->r_completed_at = Carbon::now();
        $user->save();


        Session::put('user_email', $user->username);
        Session::flash('message', 'Registered successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('payment');

    }


    public function showPayment(Request $request){

        $email = Session::get('user_email');
        if(!$email){
            Session::flash('message', 'Please try again letter');
            Session::flash('alert-class', 'alert-success');
            return redirect('/');
        }
        $merch = User::whereUsername($email)->first();
        $merchant = Contract::whereMail($email)->first();
        if($merchant->paid == 1){
            Session::flash('message', 'Already Paid');
            Session::flash('alert-class', 'alert-success');
            return redirect('/');
        }
        $amount = 100;
        // sample payment data
        Session::put('amount', $amount * 100);
        Session::put('currency', 'EUR');
        Session::put('cardType', 'CB_VISA_MASTERCARD');
        
        
        // create user for payment
        $user = new UserNatural();
    
        $user->FirstName = $merch->nome_cognome;
        $user->LastName = $merch->nome_cognome;
        $user->Email = $email;
        $user->Birthday = time();
        $user->Nationality = 'FR';
        $user->CountryOfResidence = 'FR';
        $user->Occupation = "programmer";
        $user->IncomeRange = 3;
     
        $createdUser = $this->mangoPayApi->Users->Create($user);

        Session::put('first_name', $user->FirstName);
        Session::put('last_name', $user->LastName);
        Session::put('UserNatural', $createdUser->Id);
        // register card
        $cardRegister = new CardRegistration();
        $cardRegister->UserId = $createdUser->Id;
        $cardRegister->Currency = Session::get('currency');
        $cardRegister->CardType = Session::get('cardType');
        $createdCardRegister = $this->mangoPayApi->CardRegistrations->Create($cardRegister);
        Session::put('cardRegisterId', $createdCardRegister->Id);
        Session::put('CardRegistrationURL', $createdCardRegister->CardRegistrationURL);
        Session::put('PreregistrationData', $createdCardRegister->PreregistrationData);
        Session::put('AccessKey', $createdCardRegister->AccessKey);
        // build the return URL to capture token response

        $returnUrl = route('make-payment');
        Session::put('returnUrl', $returnUrl);

        return view('merchant.payment');
    }


    public function makePayment(){
        $email = Session::get('user_email');
        if(!$email){
            Session::flash('message', 'Please try again letter');
            Session::flash('alert-class', 'alert-success');
            return redirect('/');
        }
        $merch = User::whereUsername($email)->first();
        $merchant = Contract::whereMail($email)->first();
        if($merchant->paid == 1){
            Session::flash('message', 'Already Paid');
            Session::flash('alert-class', 'alert-success');
            return redirect('/');
        }

        try {
            // update register card with registration data from Payline service
            $cardRegister = $this->mangoPayApi->CardRegistrations->Get(Session::get('cardRegisterId'));
            $cardRegister->RegistrationData = isset($_GET['data']) ? 'data=' . $_GET['data'] : 'errorCode=' . $_GET['errorCode'];
            $updatedCardRegister = $this->mangoPayApi->CardRegistrations->Update($cardRegister);

            // get created virtual card object
            $card = $this->mangoPayApi->Cards->Get($updatedCardRegister->CardId);
            // create temporary wallet for user
            $wallet = new Wallet();
            $wallet->Owners = array( $updatedCardRegister->UserId );
            $wallet->Currency = Session::get('currency');
            $wallet->Description = 'Temporary wallet for payment demo';
            $createdWallet = $this->mangoPayApi->Wallets->Create($wallet);
            // create pay-in CARD DIRECT
            $payIn = new PayIn();
            $payIn->CreditedWalletId = $createdWallet->Id;
            $payIn->AuthorId = $updatedCardRegister->UserId;
            $payIn->DebitedFunds = new Money();
            $payIn->DebitedFunds->Amount = Session::get('amount');
            $payIn->DebitedFunds->Currency = Session::get('currency');
            $payIn->Fees = new Money();
            $payIn->Fees->Amount = 0;
            $payIn->Fees->Currency = Session::get('currency');
//             payment type as CARD
            $payIn->PaymentDetails = new PayInPaymentDetailsCard();
            $payIn->PaymentDetails->CardType = $card->CardType;
            $payIn->PaymentDetails->CardId = $card->Id;
//             execution type as DIRECT
            $payIn->ExecutionDetails = new PayInExecutionDetailsDirect();
            $payIn->ExecutionDetails->SecureModeReturnURL = 'http://test.com';
//             create Pay-In
            $createdPayIn = $this->mangoPayApi->PayIns->Create($payIn);
            $payment = $this->mangoPayApi->PayIns->Get($createdPayIn->Id);
//             if created Pay-in object has status SUCCEEDED it's mean that all is fine

            if ($createdPayIn->Status == 'SUCCEEDED') {
                
                
                
                //transfer to leagal users wallet
                $Transfer = new \MangoPay\Transfer();
                $Transfer->AuthorId = Session::get('UserNatural');
                $Transfer->DebitedFunds = new \MangoPay\Money();
                $Transfer->DebitedFunds->Currency = Session::get('currency');
                $Transfer->DebitedFunds->Amount = Session::get('amount');
                $Transfer->Fees = new \MangoPay\Money();
                $Transfer->Fees->Currency = Session::get('currency');
                $Transfer->Fees->Amount = 00;
                $Transfer->DebitedWalletID = $createdWallet->Id;
                $Transfer->CreditedWalletId = $this->legalUserWalletId;
                $Transfered = $this->mangoPayApi->Transfers->Create($Transfer);
                
                $merchant->paid = 1;
                $merchant->paid_time = date('Y-m-d h:m:s');
                $merchant->paid_amount = Session::get('amount')/100;
                $merchant->save();
                Session::flash('message', 'You have been Successfully registered with us and your Payment has been done.');
                Session::flash('alert-class', 'alert-success');
                return redirect()->route('thankyou');
            }
            else {
                // if created Pay-in object has status different than SUCCEEDED
                // that occurred error and display error message
                Session::flash('message', 'facing problems With payment try again letter');
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
            }

        } catch (ResponseException $e) {
            Session::flash('message', 'Inserisci i dati correttamente :- '.$e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }

    }

}
