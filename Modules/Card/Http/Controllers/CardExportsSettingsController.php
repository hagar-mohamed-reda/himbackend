<?php

namespace Modules\Card\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Card\Entities\CardExportsSettings;

class CardExportsSettingsController extends Controller
{
    protected CardExportsSettings $cardExportsSettings;

    public function __construct(CardExportsSettings $cardExportsSettings)
    {
        $this->cardExportsSettings = $cardExportsSettings;
    }

    public function getSettings(Request $req){
        return $this->cardExportsSettings->getSettings($req->year_id , $req->term_id);
    }
   
    public function storeSettings(Request $req){
        $data = $req->settings;
         $this->cardExportsSettings->storeSettings($data);
        return response(responseJson(0, __('ADD')), 200);
    }
}
