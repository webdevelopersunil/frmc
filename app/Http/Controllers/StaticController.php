<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticController extends Controller
{
    /**
     *
     * @return array
     */
    public static function ndoalOfficer(){
        // return true;
        return array( 'Nodal Officer' );
    }

    /**
     *
     * @return array
     */
    public static function staticFunction2(){

        return true;
    }
}
