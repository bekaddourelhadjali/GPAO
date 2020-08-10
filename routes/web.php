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

Route::get('/',function(){
    return redirect('home');
}) ;


Auth::routes();

Route::get('/home', function(){
    if(\Illuminate\Support\Facades\Auth::check()){
        return redirect(route('Dashboard.index'));
    }else{
        return view('home');
    }
}
)->name('home');

Route::post('/bobine', function () {
    $rapport = \App\Fabrication\Rapport::find($_POST['NumRap']);
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
    } else if ($_POST['source'] == 'RecBob') {
        $bobine->ZoneAddSaisie = 'RecBob';
    }
    $bobine->Pid = $_POST["Pid"];
    $bobine->Did = $_POST["Did"];
    $bobine->AgentAddSaisie = $rapport->NomAgents;
    $bobine->RapportAddSaisie = $rapport->Numero;
    $bobine->DateAddSaisie = date('Y-m-d H:i:s');
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

Route::resource('affectations', 'Dashboard\AffectationsController')->middleware('auth')->middleware('admin');
Route::resource('agents', 'Dashboard\AgentsController')->middleware('auth')->middleware('admin');
Route::resource('Locations', 'Dashboard\LocationsController')->middleware('auth')->middleware('admin');
Route::resource('clients', 'Dashboard\ClientsController')->middleware('auth')->middleware('admin');
Route::resource('projects', 'Dashboard\ProjectsController')->middleware('auth')->middleware('admin');
Route::resource('Defauts', 'Dashboard\DefautsController')->middleware('auth')->middleware('admin');
Route::resource('Operations', 'Dashboard\OperationsController')->middleware('auth')->middleware('admin');
Route::resource('users', 'Dashboard\UsersController')->middleware('auth')->middleware('admin');
Route::resource('details_project', 'Dashboard\ProjectDetailsController')->middleware('auth')->middleware('admin');
Route::resource('ContRecBob', 'Controle\ContRecBobController')->middleware('ChefProd:000');
Route::resource('ListeGlobale', 'Dashboard\ListeGlobaleController')->middleware('auth');
Route::resource('Dashboard','Dashboard\DashboardController')->middleware('auth');
Route::resource('DashboardAdv','Dashboard\DashboardAdvController')->middleware('auth');
Route::get('resetpassword',function(){
   return view('auth.passwords.reset',['token'=>csrf_token()]);
})->name('resetpassword')->middleware('auth');

Route::post('resetpassword',function(\Illuminate\Http\Request $request){
    $user=User::where('username','=',$request->username)->first();
       // ->where('password','=',\Illuminate\Support\Facades\Hash::make($request->oldpassword))->first();
    if(isset($user) && $user!=null &&\Illuminate\Support\Facades\Hash::check($request->oldpassword,$user->password)){

        $user->password=\Illuminate\Support\Facades\Hash::make($request->password);
        if($user->save()){
            return response()->json(array('Success' => 'Success'), 200);
        }else{
            return response()->json(array('error' => error), 404);
        }
    }else{
        return response()->json(array('message' => "Mot De passe Erroné" ), 404);
    }
    return response()->json(array('error' => error), 404);
})->name('resetpassword')->middleware('auth');
//RecBob
Route::resource('RecBobReport', 'Reports\RecBobReportController')->middleware('auth');
Route::resource('RecBobRepAdv', 'Reports\RecBobRepAdvController')->middleware('auth');
Route::resource('RecBobDailyRep', 'Reports\RecBobDailyRepController')->middleware('auth');
Route::resource('rapports_RecBob', 'Reception\RecBobRapportsController')->middleware('Rapports:RecBob');
Route::resource('RecBob', 'Reception\RecBobController')->middleware('ChefProd:RecBob');
Route::resource('ContBobine', 'Controle\ContBobineController')->middleware('ChefProd:RecBob');

//M3
Route::resource('M3Report', 'Reports\M3\M3ReportController')->middleware('auth');
Route::resource('M3RepAdv', 'Reports\M3\M3RepAdvController')->middleware('auth');
Route::resource('M3DailyRep', 'Reports\M3\M3DailyRepController')->middleware('auth');
Route::resource('rapports_M3', 'M3\M3RapportsController')->middleware('Rapports:Z00');
Route::resource('M3', 'M3\M3Controller')->middleware('ChefProd:Z00');

//Fabrication
Route::resource('MasEPrep', 'Fabrication\MasEPrepController')->middleware('ChefProd:Z01');
Route::resource('rapports', 'Fabrication\RapportsController')->middleware('Rapports:Z01');
Route::resource('rapprod', 'Fabrication\RapprodController')->middleware('ChefProd:Z01');
Route::resource('arret_machine', 'Fabrication\ArretMachineController');
Route::resource('FabReport', 'Reports\FAB\FABReportController')->middleware('auth');
Route::resource('FabRepAdv', 'Reports\FAB\FABRepAdvController')->middleware('auth');
Route::resource('FabDailyRep', 'Reports\FAB\FABDailyRepController')->middleware('auth');

//US
Route::resource('rapports_Ultrason', 'Fabrication\UltrasonRapportsController')->middleware('Rapports:US');
Route::resource('Ultrason', 'Fabrication\UltrasonController')->middleware('ChefCont:US');
Route::resource('USReport', 'Reports\US\USReportController')->middleware('auth');
Route::resource('USRepAdv', 'Reports\US\USRepAdvController')->middleware('auth');
Route::resource('USDailyRep', 'Reports\US\USDailyRepController')->middleware('auth');

//Visuel
Route::resource('rapports_visuels', 'Visuel\RapportsVisuelsController')->middleware('Rapports:Z02');
Route::resource('visuels', 'Visuel\VisuelsController')->middleware('ChefCont:Z02');
Route::resource('VisuelReport', 'Reports\Visuel\VisuelReportController')->middleware('auth');
Route::resource('VisuelRepAdv', 'Reports\Visuel\VisuelRepAdvController')->middleware('auth');
Route::resource('VisuelDailyRep', 'Reports\Visuel\VisuelDailyRepController')->middleware('auth');

//RX1
Route::resource('rapports_RX1', 'RX1\RapportsRX1Controller')->middleware('Rapports:Z03');
Route::resource('RX1', 'RX1\RX1Controller')->middleware('ChefCont:Z03');
Route::resource('RX1Report', 'Reports\RX1\RX1ReportController')->middleware('auth');
Route::resource('RX1RepAdv', 'Reports\RX1\RX1RepAdvController')->middleware('auth');
Route::resource('RX1DailyRep', 'Reports\RX1\RX1DailyRepController')->middleware('auth');

//Reparation
Route::resource('Reparation', 'RepM17\ReparationController')->middleware('ChefProd:Z04');
Route::resource('rapports_Rep', 'RepM17\ReparationRapportController')->middleware('Rapports:Z04');
Route::resource('RepReport', 'Reports\Rep\RepReportController')->middleware('auth');
Route::resource('RepRepAdv', 'Reports\Rep\RepRepAdvController')->middleware('auth');
Route::resource('RepDailyRep', 'Reports\Rep\RepDailyRepController')->middleware('auth');

//Chutage M17
Route::resource('rapports_M17', 'RepM17\M17RapportController')->middleware('Rapports:Z05');
Route::resource('M17', 'RepM17\M17Controller')->middleware('ChefProd:Z05');
Route::resource('M17Report', 'Reports\M17\M17ReportController')->middleware('auth');
Route::resource('M17RepAdv', 'Reports\M17\M17RepAdvController')->middleware('auth');
Route::resource('M17DailyRep', 'Reports\M17\M17DailyRepController')->middleware('auth');

//M24
Route::resource('rapports_M24', 'Hydro\M24RapportController')->middleware('Rapports:Z06');
Route::resource('M24', 'Hydro\M24Controller')->middleware('ChefProd:Z06');
Route::resource('M24Report', 'Reports\M24\M24ReportController')->middleware('auth');
Route::resource('M24RepAdv', 'Reports\M24\M24RepAdvController')->middleware('auth');
Route::resource('M24DailyRep', 'Reports\M24\M24DailyRepController')->middleware('auth');

//M25
Route::resource('rapports_M25', 'Chanf\M25RapportController')->middleware('Rapports:Z07');
Route::resource('M25', 'Chanf\M25Controller')->middleware('ChefProd:Z07');
Route::resource('M25Report', 'Reports\M25\M25ReportController')->middleware('auth');
Route::resource('M25RepAdv', 'Reports\M25\M25RepAdvController')->middleware('auth');
Route::resource('M25DailyRep', 'Reports\M25\M25DailyRepController')->middleware('auth');

//NDT
Route::resource('rapports_Ndt', 'Ndt\NdtRapportController')->middleware('Rapports:Z08');
Route::resource('Ndt', 'Ndt\NdtController')->middleware('ChefCont:Z08');
Route::resource('NDTReport', 'Reports\NDT\NDTReportController')->middleware('auth');
Route::resource('NDTRepAdv', 'Reports\NDT\NDTRepAdvController')->middleware('auth');
Route::resource('NDTDailyRep', 'Reports\NDT\NDTDailyRepController')->middleware('auth');

//RX2
Route::resource('rapports_RX2', 'RX2\RapportsRX2Controller')->middleware('Rapports:Z09');
Route::resource('RX2', 'RX2\RX2Controller')->middleware('ChefCont:Z09');
Route::resource('RX2Report', 'Reports\RX2\RX2ReportController')->middleware('auth');
Route::resource('RX2RepAdv', 'Reports\RX2\RX2RepAdvController')->middleware('auth');
Route::resource('RX2DailyRep', 'Reports\RX2\RX2DailyRepController')->middleware('auth');

//VF
Route::resource('rapports_VisuelFinal', 'Visuel\RapportsVisuelFinalController')->middleware('Rapports:Z10');
Route::resource('VisuelFinal', 'Visuel\VisuelFinalController')->middleware('ChefCont:Z10');
Route::resource('VFReport', 'Reports\VF\VFReportController')->middleware('auth');
Route::resource('VFRepAdv', 'Reports\VF\VFRepAdvController')->middleware('auth');
Route::resource('VFDailyRep', 'Reports\VF\VFDailyRepController')->middleware('auth');

//VFR
Route::resource('rapports_VFRefuses', 'Visuel\RapportsVFRefusesController')->middleware('Rapports:DEC');
Route::resource('VFRefuses', 'Visuel\VFRefusesController')->middleware('ChefCont:DEC');
Route::resource('VFRReport', 'Reports\VFR\VFRReportController')->middleware('auth');
Route::resource('VFRRepAdv', 'Reports\VFR\VFRRepAdvController')->middleware('auth');
Route::resource('VFRDailyRep', 'Reports\VFR\VFRDailyRepController')->middleware('auth');

//Reception
Route::resource('rapports_Reception', 'Reception\RecTubeRapportsController')->middleware('Rapports:Z11');
Route::resource('Reception', 'Reception\RecTubeController')->middleware('ChefCont:Z11');
Route::resource('RecReport', 'Reports\Rec\RecReportController')->middleware('auth');
Route::resource('RecRepAdv', 'Reports\Rec\RecRepAdvController')->middleware('auth');
Route::resource('RecDailyRep', 'Reports\Rec\RecDailyRepController')->middleware('auth');

//RevInt
Route::resource('rapports_RevInt', 'Revetement\RevIntRapportsController')->middleware('Rapports:Z12');
Route::resource('RevInt', 'Revetement\RevIntController')->middleware('ChefCont:Z12');
Route::resource('RevIntReport', 'Reports\RevInt\RevIntReportController')->middleware('auth');
Route::resource('RevIntRepAdv', 'Reports\RevInt\RevIntRepAdvController')->middleware('auth');
Route::resource('RevIntDailyRep', 'Reports\RevInt\RevIntDailyRepController')->middleware('auth');

//RevExt
Route::resource('rapports_RevExt', 'Revetement\RevExtRapportsController')->middleware('Rapports:Z13');
Route::resource('RevExt', 'Revetement\RevExtController')->middleware('ChefCont:Z13');
Route::resource('RevExtReport', 'Reports\RevExt\RevExtReportController')->middleware('auth');
Route::resource('RevExtRepAdv', 'Reports\RevExt\RevExtRepAdvController')->middleware('auth');
Route::resource('RevExtDailyRep', 'Reports\RevExt\RevExtDailyRepController')->middleware('auth');

//Expedition
Route::resource('rapports_Expedition', 'Expedition\ExpeditionRapportsController')->middleware('Rapports:Z14');
Route::resource('Expedition', 'Expedition\ExpeditionController')->middleware('ChefCont:Z14');
Route::resource('ExpReport', 'Reports\Exp\ExpReportController')->middleware('auth');
Route::resource('ExpRepAdv', 'Reports\Exp\ExpRepAdvController')->middleware('auth');
Route::resource('ExpDailyRep', 'Reports\Exp\ExpDailyRepController')->middleware('auth');

//RevInt Fonctionnement
Route::resource('rapports_FoncRevInt', 'Fonctionnement\FoncRevIntRapportsController')->middleware('Rapports:FZ12');
Route::resource('FoncRevInt', 'Fonctionnement\FoncRevIntController')->middleware('ChefProd:FZ12');

//RevExt Fonctionnement
Route::resource('rapports_FoncRevExt', 'Fonctionnement\FoncRevExtRapportsController')->middleware('Rapports:FZ13');
Route::resource('FoncRevExt', 'Fonctionnement\FoncRevExtController')->middleware('ChefProd:FZ13');

//Rapports

//Route::resource('ContM3', 'Controle\ContM3Controller');

Route::get('CarteTube/getTubes/{Did}', function ($Did) {
    $tubes = $tube = \App\Fabrication\Tube::where('Did', '=', $Did)->select('NumTube', 'Tube', 'Bis')->get();
    return response()->json(array('tubes' => $tubes), 200);
});
Route::get('CarteTube/getTubeData/{Tube}', function (\Illuminate\Http\Request $request, $Tube) {

    $Fournisseur = '';
    $tubeBis = false;
    $tubeBisStr = substr($Tube, 5, 3);
    if ($tubeBisStr == 'bis') {
        $tubeBis = true;
    }
    $tube = \App\Fabrication\Tube::where('Tube', '=', substr($Tube, 0, 5))->where('Bis', '=', $tubeBis)->where('Did', '=', $request->Did)->first();
    if ($tube->Z01) {
        $Fournisseur = \App\Fabrication\Bobine::where('Bobine', '=', $tube->Bobine)->where('Coulee', '=', $tube->Coulee)->first()->Fournisseur;
    }
    return response()->json(array(
        'tube' => $tube,
        'visuels' => $tube->visuels,
        'RX1' => $tube->RX1,
        'Reparation' => $tube->Reparation,
        'M17' => $tube->M17,
        'M24' => $tube->M24,
        'M25' => $tube->M25,
        'NDT' => $tube->NDT,
        'RX2' => $tube->RX2,
        'VisuelFinal' => $tube->VisuelFinal,
        'VFRefuses' => $tube->VFRefuses,
        'Reception' => $tube->Reception,
        'RevInt' => $tube->RevInt,
        'RevExt' => $tube->RevExt,
        'Expedition' => $tube->Expedition,
        'Fournisseur' => $Fournisseur,
    ), 200);

});

Route::get('GetDetailsProjet',function (){
    $details= \Illuminate\Support\Facades\DB::select('Select p."Nom",d."Did",d."Epaisseur",d."Diametre" from "projet" p join "detailprojet" d 
          on p."Pid"=d."Pid" where p."Etat"!=\'C\'');

    return response()->json(array('details' => $details), 200);
})->name('GetDetailsProjet')->middleware('auth');
Route::get('Rep_M17', function () {
    $projet = \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);

    return view('RepM17.index', ['projet' => $projet]);
})->name('Rep_M17');

//
//Route::get('rapprodsRapport/{id}', function ($id) {
//    $m3 = \App\Fabrication\M3::find(1);
//    $bobine = $m3->Bobine;
//    return $m3->Bobine;
//
//})/*->middleware('UnAuthorized:Z01')*/
//;


Route::get('UnAuthorized', function () {
    return view('Errors.Unauthorized');
})->name('UnAuthorized');
Route::get('dernierTube/{id}', function ($id) {
    $dernierTube = \App\Fabrication\Rapprod::where('Did', '=', $_GET["Did"])->where('Machine', '=', $id)->orderBy('DateSaisie', 'desc')->first();
    if ($dernierTube != null)
        if ($dernierTube->Tube != "" && $dernierTube->Tube != null && $dernierTube->rapport) {
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

})->name('operateur')->middleware('UnAuthorized:Z01');
Route::post('/delete_operateur', function () {
    $operateur = \App\Fabrication\Operateur::find($_POST['id']);
    if ($operateur->delete()) {
        return response()->json(array('success' => true), 200);

    } else {
        return response()->json(array('error' => true), 404);
    }

})->name('delete_operateur')->middleware('UnAuthorized:Z01');


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
//Reports Rapports State Management
Route::post('RapportState/{id}', function (\Illuminate\Http\Request $request,$id) {
    $rapport = \App\Fabrication\Rapport::find($id);
    $rapport->Etat = $request->Etat;
    if ($rapport->save()) {
        $rapportState = [
            'Etat' => $rapport->Etat,
            'Numero' => $id
        ];
        return response()->json(array('rapportState' => $rapportState), 200);
    } else {
        return response()->json(array('error' => error), 404);
    }
});



Route::post('couleeGet', function (\Illuminate\Http\Request $request) {
    if (isset($request->source)) {
        if ($request->source == "M3") {
            if ($request->etat == 'REC') {
                $coulee = \App\Fabrication\Bobine::where('Bobine', '=', $request->bobine)->where(function ($query) {
                    return $query->where('Etat', '=', 'REC')->orWhere('Etat', '=', 'M3');
                })->first();
            } else {
                $coulee = \App\Fabrication\Bobine::where('Bobine', '=', $request->bobine)->where(function ($query) {
                    return $query->where('Etat', '=', 'NonREC')->orWhere('Etat', '=', 'M3');
                })->first();
            }
        } else if ($request->source == "MasE") {
            if ($request->etat == 'REC') {
                $coulee = \App\Fabrication\Bobine::where('Bobine', '=', $request->bobine)->where(function ($query) {
                    return $query->where('Etat', '=', 'REC')->orWhere('Etat', '=', 'MasE');
                })->first();
            } else {
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
            if ($request->etat == 'REC') {
                $bobines = \App\Fabrication\Bobine::where('Coulee', '=', $request->coulee)->where(function ($query) {
                    return $query->where('Etat', '=', 'REC')->orWhere('Etat', '=', 'M3');
                })->get();
            } else {
                $bobines = \App\Fabrication\Bobine::where('Coulee', '=', $request->coulee)->where(function ($query) {
                    return $query->where('Etat', '=', 'NonREC')->orWhere('Etat', '=', 'M3');
                })->get();
            }

        } else if ($request->source == "MasE") {
            if ($request->etat == 'REC') {
                $bobines = \App\Fabrication\Bobine::where('Coulee', '=', $request->coulee)->where(function ($query) {
                    return $query->where('Etat', '=', 'REC')->orWhere('Etat', '=', 'MasE');
                })->get();
            } else {
                $bobines = \App\Fabrication\Bobine::where('Coulee', '=', $request->coulee)->where(function ($query) {
                    return $query->where('Etat', '=', 'NonREC')->orWhere('Etat', '=', 'MasE');
                })->get();
            }

        }
    } else if (isset($request->machine)) {
        if ($request->machine == "E") {
            $bobines = \App\Fabrication\Bobine::where('Coulee', '=', $request->coulee)->where('Did', '=', $request->Did)->where('Etat', '=', 'MasEPrep')->get();

        } else {
            $bobines = \App\Fabrication\Bobine::where('Coulee', '=', $request->coulee)->where('Did', '=', $request->Did)->where('Etat', '=', 'Prep')->get();
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

Route::fallback(function () {
    return \redirect('UnAuthorized');
});

