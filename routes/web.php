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
Route::post('/bobine',function( ){
    $bobine= new \App\Fabrication\Bobine();
    $bobine->Bobine=$_POST['bobine'];
    $bobine->Coulee=$_POST['coulee'];
    $bobine->CodeFournis=$_POST['fournisseur'];
    $bobine->Poids=$_POST['poids'];
    $bobine->Did=$_POST['Did'];
    $bobine->Pid=$_POST['Pid'];
//    if( $bobine->insertBobine()) {
//        return redirect(route('rapprod.show',['id'=>$_POST['RapportNum']]));
//    }
    if ($bobine->insertBobine()){
        return response()->json(array('bobine'=> $bobine), 200);

    }else{
        return response()->json(array('error'=> error), 404);

    }
})->name('bobine');

Route::resource('details_project','Dashboard\ProjectDetailsController');
Route::resource('rapports','Fabrication\RapportsController');

    //->middleware('UnAuthorized:Z01');
Route::resource('rapprod','Fabrication\RapprodController');
    //->middleware('UnAuthorized:Z01');
Route::resource('arret_machine','Fabrication\ArretMachineController');
Route::resource('rapports_visuels','Visuel\RapportsVisuelsController');
Route::resource('visuels','Visuel\VisuelsController');
Route::resource('affectations','Dashboard\AffectationsController');
Route::resource('agents','Dashboard\AgentsController');
Route::resource('Locations','Dashboard\LocationsController');
Route::resource('machines','Dashboard\MachinesController');
Route::resource('clients','Dashboard\ClientsController');
Route::resource('projects','Dashboard\ProjectsController');
Route::resource('rapports_RX1','RX1\RapportsRX1Controller');
Route::resource('RX1','RX1\RX1Controller');
Route::get('Rep_M17',function(){
    $projet = \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);

    return view('RepM17.index',['projet'=>$projet]);
});
Route::get('rapprodsRapport/{id}',function($id){
    $rapport=\App\Fabrication\Rapport::find($id);
//    if(sizeof($rapport->rx1) || sizeof($rapport->arrets)){
//
//    }
    return $rapport->rx1 ;
})/*->middleware('UnAuthorized:Z01')*/;
Route::get('UnAuthorized',function(){
    return view('Errors.Unauthorized');
})->name('UnAuthorized');
Route::get('dernierTube/{id}',function($id){
    $result=DB::select('SELECT "Numero"  FROM public.rapprod where (select max("DateSaisie") from public.rapprod)="DateSaisie"  and "Machine"=?',[$id])[0];
    $dernierTube = \App\Fabrication\Rapprod::find($result->Numero );
    if($dernierTube->Tube!=""){
        $dernierTubetab= ['Tube'=>$dernierTube->Tube
            ,'Observation'=>$dernierTube->Observation
            ,'Numero'=>$dernierTube->rapport->Numero
            ,'Date'=>$dernierTube->rapport->DateRapport
            ,'Equipe'=>$dernierTube->rapport->Equipe
            ,'Poste'=>$dernierTube->rapport->Poste
        ];
        if ($dernierTube->Tube!=""&&$dernierTube->Tube!=null){
            return response()->json(array('dernierTubetab'=> $dernierTubetab), 200);

        }else{
            return response()->json(array('error'=> error), 404);

        }
    }

});
Route::post('/operateur',function( ){
    $operateur = new \App\Fabrication\Operateur();
    $operateur->Pid = $_POST['Pid'];
    $operateur->Did = $_POST['Did'];
    $operateur->NumRap = $_POST['NumRap'];
    $operateur->Nom = $_POST['Nom'];
    if ($operateur->save()){
        return response()->json(array('operateur'=> $operateur), 200);

    }else{
       return response()->json(array('error'=> error), 404);

    }

})->name('operateur');
Route::post('/delete_operateur',function( ){
    $operateur = \App\Fabrication\Operateur::find( $_POST['id']);
    if ($operateur->delete()){
        return response()->json(array('success'=> true), 200);

    }else{
       return response()->json(array('error'=> true), 404);
    }

})->name('delete_operateur');

Route::get('reprendreTube/{id}',function($id){
    $result=DB::select('SELECT "Numero"  FROM public.rapprod where  "Tube"=?',[$id])[0];
    $dernierTube = \App\Fabrication\Rapprod::find($result->Numero );
    if ($dernierTube->Tube!=""&&$dernierTube->Tube!=null){
        if($dernierTube->rapport->Etat=='C'){

            $rapportState = [
                'Etat'=>'C',
                'Numero'=> $dernierTube->rapport->Numero
            ];
           return response()->json(array('rapportState'=> $rapportState), 200);
        }elseif($dernierTube->rapport->Etat=='N'){
            $rapportState = [
                'Etat'=>'N',
                'Numero'=> $dernierTube->rapport->Numero
            ];
            return response()->json(array('rapportState'=> $rapportState), 200);
        }else{
            return response()->json(array('error'=> error), 404);
        }
        }else{
            return response()->json(array('error'=> error), 404);

        }

});
Route::post('cloturer/{id}',function($id){
    $rapport=\App\Fabrication\Rapport::find($id);
     $rapport->Etat='C';
     if(isset($_POST['arret_clot'])){
         $rapport->ObsRap=$_POST['ObsRap'];
         $rapport->TSIFlux=$_POST['flux_int'];
         $rapport->TSIFil=$_POST['fil_int'];
         $rapport->TSEFlux=$_POST['flux_ext'];
         $rapport->TSEFil=$_POST['fil_ext'];
         $rapport->VSoudage=$_POST['v_soudage'];
         $rapport->LargCisAlge=$_POST['largeur'];
         $rapport->Flux=$_POST['flux'];
         $rapport->Fil=$_POST['fil'];
     }
    if($rapport->save()){
        $rapportState = [
            'Etat'=>'C',
            'Numero'=> $id
        ];
        return response()->json(array('rapportState'=> $rapportState), 200);
    }else{
        return response()->json(array('error'=> error), 404);
    }
});

Route::get('reprendreVisuels/{id}',function( \Illuminate\Http\Request $request,$id){
    $tab="";
    if($request->Zone=="Z02"){
        $tab ='visuels';
    }elseif($request->Zone=="Z03"){
        $tab ='rx1';
    }
    $results=DB::select('Select * from public.rapports where "Numero" in (SELECT "NumeroRap"  FROM public.'.$tab.' where  "Tube"=?)',[$id]);
    if ($results!=null){
            return response()->json(array('rapports'=> $results), 200);
    }else{
        return response()->json(array('error'=> error), 404);

    }

});
Route::get('printRap/{id}',function($id){
    $rapport =\App\Fabrication\Rapport::find($id);
    if($rapport!=null) {
        if($rapport->Zone=='Z02'){
                $projet = \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);

                return view('visuel.RapVPrint',
                    ['rapport' => $rapport,
                        'visuels'=>$rapport->visuels,
                        'projet' => $projet,
                        'arrets'=>$rapport->arrets, ]);
        }else{
            return redirect(route('rapports_visuels.index'));
        }
    }else{
        return redirect(route('rapports_visuels.index'));
    }
})->name('printRap');
Route::get('printRX1Rap/{id}',function($id){
    $rapport =\App\Fabrication\Rapport::find($id);
    if($rapport!=null) {
        if($rapport->Zone=='Z03'){
            $projet = \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);

            return view('RX1.RX1Print',
                ['rapport' => $rapport,
                    'rxs'=>$rapport->rx1,
                    'projet' => $projet,
                    'arrets'=>$rapport->arrets, ]);
        }else{
            return redirect(route('rapports_RX1.index'));
        }
    }else{
        return redirect(route('rapports_RX1.index'));
    }
})->name('printRX1Rap');

Route::get('users',function(){
    $projet = \App\Fabrication\Projet::find(DB::select('select "Pid" from "projet" where CURRENT_DATE between "StartDate" and "EndDate" limit 1')[0]->Pid);
    return view('Dashboard.users',["projet"=>$projet]);
});
