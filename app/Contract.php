<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contracts';
    protected $fillable = [
        'titolare',
        'Piva',
        'codice_agente',
        'mail',
        'telefono_cellulare',
        'nomeattivita',
        'tipo_contratto',
        'Conferma',
        'Orario',
        'prezzo_minimo',
        'prezzo_massimo',
        'sconto_minimo',
        'sconto_massimo',
        'descrizione',
        'indirizzo',
        'telefono_fisso',
        'sito',
        'link_facebook',
        'link_instagram',
        'link_trip_advisor',
        'link_youtube',
        'link_pinterest',
        'paid',
        'paid_time',
        'paid_amount',
    ];
}
