<?php

use App\User;
use App\Product;
use App\Avis;
use App\Question;
use App\Category;
use App\Response;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/',function(){
//    return redirect('home');
//}) ;


Auth::routes();

//Route::get('/forum',function(){
//    $questions=Question::all();
//    return view('forum',["questions"=>$questions]);
//})->name('forum');
//
//Route::get('/dashboard',function(){
//    return view('dashboard');
//})->name('dashboard')->middleware('auth')->middleware('admin');
//
//Route::get('/product/{id}',function(){
//    return view('product');
//})->name('product');
//
//Route::get('/product',function(){
//    return redirect('home');
//})->name('product');
//
//Route::get('/product/{id}',function($id){
//    $product=product::findOrFail($id);
//    $comments=$product->avis;
//    return view('product',['product'=>$product,'comments'=>$comments]);
//})->name('product.index');
//Route::get('/product/{id}/{comment}',function($id,$comment){
//
//    $product=product::findOrFail($id);
//    $comments=$product->avis;
//    $comment_e=Avis::findOrFail($comment);
//    return view('product',['product'=>$product,'comments'=>$comments,'comment_e'=>$comment_e]);
//})->name('product.index.edit');
//
//
//Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
//
//Route::get('/settings', function(){
//    return view("settings");
//})->name('settings')->middleware('auth');
//
//Route::post('/settings',function(){
//    $user=new User;
//    $user=User::where('id',Auth::user()->id)->update(["name"=>$_POST['name'],"email"=>$_POST['email'],"daten"=>$_POST['daten'],"address"=>$_POST['address'],"phone"=>$_POST['phone']]);
//    return redirect()->route('home');
//})->name('settings')->middleware('auth');
//
//Route::resource('category','CategoriesController')->middleware( 'auth')->middleware('admin') ;
//
//Route::resource('products','ProductsController')->middleware('auth')->middleware('admin');
//
//Route::resource('sales','SalesController')->middleware('auth');
//
//Route::resource('avis','AvisController')->middleware('auth');
///* example */
//Route::get('/store/category/{id}', function(Request $request,$id){
//    $category=Category::findOrFail($id);
//     $products = $category->products;
//     return view('home',["products"=>$products,"category_s"=>$category]);
//
//
//})->name('store.category');
//
//Route::get('search', function( ){
//    $products = Product::where('name','like',"%".$_GET["search"]."%")->orWhere('description','like',"%".$_GET["search"]."%")->get();
//
//      return view('home',['products'=>$products]) ;
//
//})->name('search');
//Route::resource('question','QuestionsController')->middleware('auth');
//Route::resource('response','ResponsesController')->middleware('auth');

/*Route::filter('search',function(){
    if(Auth::guest()){
        return Redirect::guest('login');
    }
    return Redirect::intended();
});*/
//Route::get('rapport',function(){
//   return view('Fabrication.rapport_info');});

Route::post('/bobine', function () {
    $rapport=\App\Fabrication\Rapport::find($_POST['NumRap']);
    $bobine = new \App\Fabrication\Bobine();
    $bobine->Bobine = $_POST['bobine'];
    $bobine->Coulee = $_POST['coulee'];
    $bobine->Poids = $_POST['poids'];
    if (isset($_POST['poids_b'])) {
        $bobine->Poids_b = $_POST['poids_b'];
    }
    if (isset($_POST['epaisseur'])) {
        $bobine->Epaisseur = $_POST['epaisseur'];
    }
    if (isset($_POST['arrivage'])) {
        $bobine->Arrivage = $_POST['arrivage'];
    }
    if (isset($_POST['largeur_bande'])) {
        $bobine->LargeurBande = $_POST['largeur_bande'];
    }
    $bobine->DateSaisie = date('Y-m-d H:i:s');
    if (isset($_POST['source'])) if ($_POST['source'] == 'M3') {
        $bobine->Etat = 'M3';
        $bobine->ZoneAddSaisie = 'M3';
    } else if ($_POST['source'] == 'MasE') {
        $bobine->Etat = 'MasE';
        $bobine->ZoneAddSaisie = 'MasE';
    }else if($_POST['source'] == 'RecBob'){
        $bobine->ZoneAddSaisie = 'RecBob';
    }
    $bobine->Pid = $_POST["Pid"];
    $bobine->Did = $_POST["Did"];
    $bobine->AgentAddSaisie  =$rapport->NomAgents;
	$bobine->RapportAddSaisie  =$rapport->Numero;
	$bobine->DateAddSaisie  =date('Y-m-d H:i:s');
    if ($bobine->save()) {

        if (isset($_POST['source'])) {
            if ($_POST['source'] == 'M3') {
                $bobines = \App\Fabrication\Bobine::where('Etat', '=', 'M3')->orWhere('Etat', '=', 'REC')->select('Bobine')->get();
                $coulees = \App\Fabrication\Bobine::where('Etat', '=', 'M3')->orWhere('Etat', '=', 'REC')->select('Coulee')->distinct('Coulee')->get();
                return response()->json(array('bobine' => $bobine, "bobines" => $bobines, "coulees" => $coulees), 200);
            } else if ($_POST['source'] == 'MasE') {
                $bobines = \App\Fabrication\Bobine::where('Etat', '=', 'MasE')->orWhere('Etat', '=', 'REC')->select('Bobine')->get();
                $coulees = \App\Fabrication\Bobine::where('Etat', '=', 'MasE')->orWhere('Etat', '=', 'REC')->select('Coulee')->distinct('Coulee')->get();
                return response()->json(array('bobine' => $bobine, "bobines" => $bobines, "coulees" => $coulees), 200);
            } else if ($_POST['source'] == 'RecBob') {
                $bobinesCount = \App\Fabrication\Bobine::where('NbReception', '=', null)->select('Bobine')->count();
                return response()->json(array('bobine' => $bobine, 'Count' => $bobinesCount), 200);
            }
        }
    } else {
        return response()->json(array('error' => error), 404);

    }
})->name('bobine');

//Dashboard

Route::resource('affectations', 'Dashboard\AffectationsController');
Route::resource('agents', 'Dashboard\AgentsController');
Route::resource('Locations', 'Dashboard\LocationsController');
Route::resource('machines', 'Dashboard\MachinesController');
Route::resource('clients', 'Dashboard\ClientsController');
Route::resource('projects', 'Dashboard\ProjectsController');
Route::resource('Defauts', 'Dashboard\DefautsController');
Route::resource('Operations', 'Dashboard\OperationsController');

//Rapports
Route::resource('details_project', 'Dashboard\ProjectDetailsController');
Route::resource('ContBobine', 'Controle\ContBobineController');
Route::resource('ContM3', 'Controle\ContM3Controller');
Route::resource('ContRecBob', 'Controle\ContRecBobController');
Route::resource('rapports_M3', 'M3\M3RapportsController');
Route::resource('M3', 'M3\M3Controller');
Route::resource('MasEPrep', 'Fabrication\MasEPrepController');
Route::resource('rapports_RecBob', 'Reception\RecBobRapportsController');
Route::resource('RecBob', 'Reception\RecBobController');
Route::resource('rapports', 'Fabrication\RapportsController');
//->middleware('UnAuthorized:Z01');
Route::resource('rapprod', 'Fabrication\RapprodController');
//->middleware('UnAuthorized:Z01');
Route::resource('rapports_Ultrason', 'Fabrication\UltrasonRapportsController');
Route::resource('Ultrason', 'Fabrication\UltrasonController');
Route::resource('arret_machine', 'Fabrication\ArretMachineController');
Route::resource('rapports_visuels', 'Visuel\RapportsVisuelsController');
Route::resource('visuels', 'Visuel\VisuelsController');
Route::resource('rapports_RX1', 'RX1\RapportsRX1Controller');
Route::resource('RX1', 'RX1\RX1Controller');
Route::resource('Reparation', 'RepM17\ReparationController');
Route::resource('rapports_Rep', 'RepM17\ReparationRapportController');
Route::resource('rapports_M17', 'RepM17\M17RapportController');
Route::resource('M17', 'RepM17\M17Controller');
Route::resource('rapports_M24', 'Hydro\M24RapportController');
Route::resource('M24', 'Hydro\M24Controller');
Route::resource('rapports_M25', 'Chanf\M25RapportController');
Route::resource('M25', 'Chanf\M25Controller');
Route::resource('rapports_Ndt', 'Ndt\NdtRapportController');
Route::resource('Ndt', 'Ndt\NdtController');
Route::resource('rapports_RX2', 'RX2\RapportsRX2Controller');
Route::resource('RX2', 'RX2\RX2Controller');
Route::resource('rapports_VisuelFinal', 'Visuel\RapportsVisuelFinalController');
Route::resource('VisuelFinal', 'Visuel\VisuelFinalController');
Route::resource('rapports_Reception', 'Reception\RecTubeRapportsController');
Route::resource('Reception', 'Reception\RecTubeController');
Route::resource('rapports_RevInt', 'Revetement\RevIntRapportsController');
Route::resource('RevInt', 'Revetement\RevIntController');
Route::resource('rapports_RevExt', 'Revetement\RevExtRapportsController');
Route::resource('RevExt', 'Revetement\RevExtController');
Route::resource('rapports_Expedition', 'Expedition\ExpeditionRapportsController');
Route::resource('Expedition', 'Expedition\ExpeditionController');

Route::get('CarteTube/{tube}', function ($tube) {

});
Route::get('Rep_M17', function () {
    $projet = \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);

    return view('RepM17.index', ['projet' => $projet]);
})->name('Rep_M17');


Route::get('rapprodsRapport/{id}', function ($id) {
    $m3 = \App\Fabrication\M3::find(1);
    $bobine = $m3->Bobine;
    return $m3->Bobine;

})/*->middleware('UnAuthorized:Z01')*/
;


Route::get('UnAuthorized', function () {
    return view('Errors.Unauthorized');
})->name('UnAuthorized');
Route::get('dernierTube/{id}', function ($id) {
    $dernierTube = \App\Fabrication\Rapprod::where('Did', '=', $_GET["Did"])->where('Machine', '=', $id)->orderBy('DateSaisie', 'desc')->first();
    if ($dernierTube)
        if ($dernierTube->Tube != "") {
            $dernierTubetab = ['Tube' => $dernierTube->Tube
                , 'Observation' => $dernierTube->Observation
                , 'Numero' => $dernierTube->rapport->Numero
                , 'Date' => $dernierTube->rapport->DateRapport
                , 'Equipe' => $dernierTube->rapport->Equipe
                , 'Poste' => $dernierTube->rapport->Poste
            ];
            if ($dernierTube->Tube != "" && $dernierTube->Tube != null) {
                return response()->json(array('dernierTubetab' => $dernierTubetab), 200);

            } else {
                return response()->json(array('error' => error), 404);

            }
        }
    return response()->json(array('message' => "Tube N'existe Pas"), 404);

});
Route::post('/operateur', function () {
    $operateur = new \App\Fabrication\Operateur();
    $operateur->Pid = $_POST['Pid'];
    $operateur->Did = $_POST['Did'];
    $operateur->NumRap = $_POST['NumRap'];
    $operateur->Nom = $_POST['Nom'];
    if ($operateur->save()) {
        return response()->json(array('operateur' => $operateur), 200);

    } else {
        return response()->json(array('error' => error), 404);

    }

})->name('operateur');
Route::post('/delete_operateur', function () {
    $operateur = \App\Fabrication\Operateur::find($_POST['id']);
    if ($operateur->delete()) {
        return response()->json(array('success' => true), 200);

    } else {
        return response()->json(array('error' => true), 404);
    }

})->name('delete_operateur');

Route::get('reprendreTube/{id}', function ($id) {
    $rapprod = \App\Fabrication\Rapprod::where('Did', '=', $_GET["Did"])->where('Tube', '=', $id)->first();
    if ($rapprod) {
        if ($rapprod->rapport->Etat == 'C') {

            $rapportState = [
                'Etat' => 'C',
                'Numero' => $rapprod->rapport->Numero
            ];
            return response()->json(array('rapportState' => $rapportState), 200);
        } elseif ($rapprod->rapport->Etat == 'N') {
            $rapportState = [
                'Etat' => 'N',
                'Numero' => $rapprod->rapport->Numero
            ];
            return response()->json(array('rapportState' => $rapportState), 200);
        } else {
            return response()->json(array('error' => error), 404);
        }
    } else {
        return response()->json(array('message' => "Tube N'existe Pas"), 404);
    }

});
Route::post('cloturer/{id}', function ($id, \Illuminate\Http\Request $request) {
    $rapport = \App\Fabrication\Rapport::find($id);
    $rapport->Etat = 'C';
    if ($rapport->Zone == 'Z01') {
        $rapport->ObsRap = $request->ObsRap;
        $rapport->TSI1V = $request->TSI1V;
        $rapport->TSI1A = $request->TSI1A;
        $rapport->TSI2V = $request->TSI2V;
        $rapport->TSI2A = $request->TSI2A;
        $rapport->TSE1V = $request->TSE1V;
        $rapport->TSE1A = $request->TSE1A;
        $rapport->TSE2V = $request->TSE2V;
        $rapport->TSE2A = $request->TSE2A;
        $rapport->TSE3V = $request->TSE3V;
        $rapport->TSE3A = $request->TSE3A;
        $rapport->TSIFlux = $request->TSIFlux;
        $rapport->TSIFil = $request->TSIFil;
        $rapport->TSEFlux = $request->TSEFlux;
        $rapport->TSEFil = $request->TSEFil;
        $rapport->RelComptF = $request->RelComptF;
        $rapport->RelComptD = $request->RelComptD;
        $rapport->VSoudage = $request->v_soudage;
        $rapport->LargCisAlge = $request->largeur;
    }
    if (isset($_POST['observation'])) {
        $rapport->ObsRap = $_POST['observation'];
    }
    if ($rapport->save()) {
        $rapportState = [
            'Etat' => 'C',
            'Numero' => $id
        ];
        return response()->json(array('rapportState' => $rapportState), 200);
    } else {
        return response()->json(array('error' => error), 404);
    }
});
Route::post('Decloturer/{id}', function ($id) {
    $rapport = \App\Fabrication\Rapport::find($id);
    $rapport->Etat = 'N';
    if ($rapport->save()) {
        $rapportState = [
            'Etat' => 'N',
            'Numero' => $id
        ];
        return response()->json(array('rapportState' => $rapportState), 200);
    } else {
        return response()->json(array('error' => error), 404);
    }
});

Route::get('printRap/{id}', function ($id) {
    $rapport = \App\Fabrication\Rapport::find($id);
    if ($rapport != null) {
        if ($rapport->Zone == 'Z02') {
            $projet = \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);

            return view('visuel.RapVPrint',
                ['rapport' => $rapport,
                    'visuels' => $rapport->visuels,
                    'projet' => $projet,
                    'arrets' => $rapport->arrets,]);
        } else {
            return redirect(route('rapports_visuels.index'));
        }
    } else {
        return redirect(route('rapports_visuels.index'));
    }
})->name('printRap');
Route::get('printRX1Rap/{id}', function ($id) {
    $rapport = \App\Fabrication\Rapport::find($id);
    if ($rapport != null) {
        if ($rapport->Zone == 'Z03') {
            $projet = \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);

            return view('RX1.RX1Print',
                ['rapport' => $rapport,
                    'rxs' => $rapport->rx1,
                    'projet' => $projet,
                    'arrets' => $rapport->arrets,]);
        } else {
            return redirect(route('rapports_RX1.index'));
        }
    } else {
        return redirect(route('rapports_RX1.index'));
    }
})->name('printRX1Rap');

Route::get('users', function () {
    $projet = \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);
    return view('Dashboard.users', ["projet" => $projet]);
});

Route::post('couleeGet', function (\Illuminate\Http\Request $request) {
    if (isset($request->source)) {
        if ($request->source == "M3" ) {
            if($request->etat=='REC') {
                $coulee = \App\Fabrication\Bobine::where('Bobine', '=', $request->bobine)->where(function ($query) {
                    return $query->where('Etat', '=','REC' )->orWhere('Etat', '=', 'M3');
                })->first();
            }else {
                $coulee = \App\Fabrication\Bobine::where('Bobine', '=', $request->bobine)->where(function ($query) {
                    return $query->where('Etat', '=', 'NonREC')->orWhere('Etat', '=', 'M3');
                })->first();
            }
        } else if ($request->source == "MasE") {
            if($request->etat=='REC') {
                $coulee = \App\Fabrication\Bobine::where('Bobine', '=', $request->bobine)->where(function ($query) {
                    return $query->where('Etat', '=', 'REC')->orWhere('Etat', '=', 'MasE');
                })->first();
            }else{
                $coulee = \App\Fabrication\Bobine::where('Bobine', '=', $request->bobine)->where(function ($query) {
                    return $query->where('Etat', '=', 'NonREC')->orWhere('Etat', '=', 'MasE');
                })->first();
            }
        }
    } else if (isset($request->machine)) {
        if ($request->machine == "E") {
            $coulee = \App\Fabrication\Bobine::where('Bobine', '=', $request->bobine)->where('Etat', '=', 'MasEPrep')->first();
        } else {
            $coulee = \App\Fabrication\Bobine::where('Bobine', '=', $request->bobine)->where('Etat', '=', 'Prep')->first();
        }

    } else if ($request->etat == "NonREC") {
        $coulee = \App\Fabrication\Bobine::where('Bobine', '=', $request->bobine)->where('NbReception', '=', null)->first();
    } else
        $coulee = \App\Fabrication\Bobine::where('Bobine', '=', $request->bobine)->where('Etat', '=', $request->etat)->first();
    if (!empty($coulee)) {
        return response()->json(array('coulee' => $coulee), 200);
    } else {
        return response()->json(array('error' => "Bobine n'existe pas"), 404);
    }
})->name('couleeGet');
Route::post('bobineGet', function (\Illuminate\Http\Request $request) {
    if (isset($request->test))
        $bobines = \App\Fabrication\Bobine::where('Coulee', '=', $request->coulee)->where('Test', '=', $request->test)->get();
    else if (isset($request->source)) {
        if ($request->source == "M3") {
            if($request->etat=='REC'){
                $bobines = \App\Fabrication\Bobine::where('Coulee', '=', $request->coulee)->where(function ($query) {
                    return $query->where('Etat', '=','REC')->orWhere('Etat', '=', 'M3');
                })->get();
            }else{
                $bobines = \App\Fabrication\Bobine::where('Coulee', '=', $request->coulee)->where(function ($query) {
                    return $query->where('Etat', '=','NonREC')->orWhere('Etat', '=', 'M3');
                })->get();
            }

        } else if ($request->source == "MasE") {
            if($request->etat=='REC'){
            $bobines = \App\Fabrication\Bobine::where('Coulee', '=', $request->coulee)->where(function ($query) {
                return $query->where('Etat', '=','REC')->orWhere('Etat', '=', 'MasE');})->get();
            }else{
                $bobines = \App\Fabrication\Bobine::where('Coulee', '=', $request->coulee)->where(function ($query) {
                    return $query->where('Etat', '=','NonREC')->orWhere('Etat', '=', 'MasE');})->get();
                }

        }
    } else if (isset($request->machine)) {
        if ($request->machine == "E") {
            $bobines = \App\Fabrication\Bobine::where('Coulee', '=', $request->coulee)->where('Did','=',$request->Did)->where('Etat', '=', 'MasEPrep')->get();

        } else {
            $bobines = \App\Fabrication\Bobine::where('Coulee', '=', $request->coulee)->where('Did','=',$request->Did)->where('Etat', '=', 'Prep')->get();
        }

    } else if ($request->etat == "NonREC") {
        $bobines = \App\Fabrication\Bobine::where('Coulee', '=', $request->coulee)->where('NbReception', '=', null)->get();
    } else   $bobines = \App\Fabrication\Bobine::where('Coulee', '=', $request->coulee)->where('Etat', '=', $request->etat)->get();
    if ($bobines) {
        return response()->json(array('bobines' => $bobines), 200);
    } else {
        return response()->json(array('error' => "Coulee n'existe pas"), 404);
    }
})->name('bobineGet');