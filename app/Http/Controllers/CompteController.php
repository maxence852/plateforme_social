<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use app;
class CompteController extends Controller
{
    public function index()
    {
        return view('compte');
    }
}
