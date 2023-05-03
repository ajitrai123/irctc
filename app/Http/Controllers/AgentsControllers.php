<?php

namespace App\Http\Controllers;
use App\Models\Agents;
use DataTables;

use Illuminate\Http\Request;

class AgentsControllers extends Controller
{
    
    public function index()
    {
      $agent_data = Agents::get();
      return view('agents', compact('agent_data'));
     }
}
