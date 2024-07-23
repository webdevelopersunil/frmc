<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use Illuminate\Http\Request;

class AuditController extends Controller{
    
    public function index(){

        // Get first available Article
        $article = Complain::first();

        // // Get latest Audit
        // $audit = $article->audits()->latest()->first();

        // // dd($audit->getMetadata());


        $lists  =   Complain::paginate(20);
 
        return view('audits.index', compact('lists'));

    }

    public function viewAudit($id){
        
        $complain   =   Complain::first();
        // $audit      =   $article->audits()->latest()->first();

        $lists = $complain->audits()->paginate(20);
        
        return view('audits.detail', compact('lists'));
    }
}
