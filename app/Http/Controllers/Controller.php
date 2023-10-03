<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //fungsi untuk membuat tombol action di controller
    public function buttonAction($button_style,$button_id,$button_tooltip,$button_icon,$id){
        $button = '<button type="button" class="btn btn-'.$button_style.' btn-sm mx-1" id="'.$button_id.'" data-id="'.$id.'" aria-label="'.$button_tooltip.'" data-microtip-position="top" role="tooltip"><i class="'.$button_icon.'"></i></button>';
        return $button;
    }
}
