<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\agentController;
use App\Http\Controllers\appointmentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\OrdonnanceController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PermananceController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\PublicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicamentController;


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




Route::middleware(['guest'])->group(function(){

    Route::get('/login', [agentController::class, 'login'])->name('login');
    Route::post('/login', [agentController::class, 'handleLogin'])->name('login');
    Route::get('/forgotPass', [agentController::class, 'forgot_password'])->name('forgot_password');
    Route::post('/sendResetLinkEmail', [agentController::class, 'sendResetLinkEmail'])->name('send_reset_link_email');
    Route::get('/resetPass', [agentController::class, 'reset_password'])->name('reset_password');
    Route::get('/registerPass', [agentController::class, 'register_new_password'])->name('register_new_password');

    
});

Route::middleware(['auth'])->group(function(){

    Route::prefix('appointments')->group(function(){
        Route::get('/', [AppointmentController::class, 'index'])->name('appointment.info');
        Route::get('/{id}/delete', [AppointmentController::class, 'delete'])->name('appointment.delete');
        Route::get('/{id}/details',[AppointmentController::class,'show'])->name('appointment.details');
    });
    
    Route::prefix('medicaments')->group(function(){
        Route::get('/', [MedicamentController::class, 'index'])->name('medicament.info');
        Route::get('/{medicament}/delete', [MedicamentController::class, 'delete'])->name('medicament.delete');
        Route::get('/{medicament}/details', [MedicamentController::class, 'show'])->name('medicament.details');
        Route::get('/{medicament}/edit', [MedicamentController::class, 'edit'])->name('medicament.edit');
        Route::put('/{medicament}/update', [MedicamentController::class, 'update'])->name('medicament.update');
        Route::post('/add', [MedicamentController::class, 'store'])->name('medicament.add');
        Route::get('/search',[MedicamentController::class,'search'])->name('medicament.search');
    });
    
    Route::prefix('marques')->group(function(){
        Route::get('/', [MarqueController::class, 'index'])->name('marque.info');
        Route::post('/add', [MarqueController::class, 'store'])->name('marque.add');
        Route::get('/{marques}/delete', [MarqueController::class, 'delete'])->name('marque.delete');
        Route::get('/{marques}/details', [MarqueController::class, 'show'])->name('marque.details');
        Route::get('/{marques}/edit', [MarqueController::class, 'edit'])->name('marque.edit');
        Route::put('/{marques}/update', [MarqueController::class, 'update'])->name('marque.update');
    });

    Route::prefix('publications')->group(function(){
        Route::get('/', [PublicationController::class, 'index'])->name('publication.info');
        Route::post('/add', [PublicationController::class, 'store'])->name('publication.add');
        Route::get('/{publication}/delete', [PublicationController::class, 'delete'])->name('publication.delete');
        Route::get('/{publication}/details', [PublicationController::class, 'show'])->name('publication.details');
        Route::get('/{publication}/edit', [PublicationController::class, 'edit'])->name('publication.edit');
        Route::put('/{publication}/update', [PublicationController::class, 'update'])->name('publication.update');
    });

    Route::prefix('permanances')->group(function(){
        Route::get('/', [PermananceController::class, 'index'])->name('permanance.info');
        Route::post('/add', [PermananceController::class, 'store'])->name('permanance.add');
        Route::get('/{permanance}/delete', [PermananceController::class, 'delete'])->name('permanance.delete');
        Route::get('/{permanance}/details', [PermananceController::class, 'show'])->name('permanance.details');
        Route::get('/{permanance}/edit', [PermananceController::class, 'edit'])->name('permanance.edit');
        Route::put('/{permanance}/update', [PermananceController::class, 'update'])->name('permanance.update');
        Route::get('/search', [PermananceController::class, 'search'])->name('permanance.search');
    });

    Route::prefix('ordonnances')->group(function(){
        Route::get('/', [OrdonnanceController::class, 'index'])->name('ordonnance.info');
        Route::post('/add', [OrdonnanceController::class, 'store'])->name('ordonnance.add');
        Route::get('/{ordonnance}/delete', [OrdonnanceController::class, 'delete'])->name('ordonnance.delete');
        Route::get('/{ordonnance}/details', [OrdonnanceController::class, 'show'])->name('ordonnance.details');
        Route::get('/{ordonnance}/edit', [OrdonnanceController::class, 'edit'])->name('ordonnance.edit');
        Route::put('/{ordonnance}/update', [OrdonnanceController::class, 'update'])->name('ordonnance.update');
    });
    
    Route::get('/pdf/{ordonnance}', [PdfController::class, 'generatePdf'])->name('generatePDF');

    Route::prefix('promotions')->group(function(){
        Route::get('/', [PromotionController::class, 'index'])->name('promotion.info');
        Route::post('/add', [PromotionController::class, 'store'])->name('promotion.add');
        Route::get('/{promotion}/delete', [PromotionController::class, 'delete'])->name('promotion.delete');
        Route::get('/{promotion}/edit', [PromotionController::class, 'edit'])->name('promotion.edit');
        Route::put('/{promotion}/update', [PromotionController::class, 'update'])->name('promotion.update');
    });

    Route::get('/logout', [agentController::class, 'logout'])->name('logout');
    Route::get('/accueil', [agentController::class, 'accueil'])->name('accueil');
    Route::get('/show_profil', [agentController::class, 'showProfil'])->name('agent.profil');
    Route::get('/edit_profil', [agentController::class, 'editProfil'])->name('edit.profil');
    Route::put('/{agent}/update_profil', [agentController::class, 'updateProfil'])->name('update.profil');
    Route::get('new_profil', [agentController::class, 'newProfil'])->name('new.profil');
    Route::post('create_profil', [agentController::class, 'createProfil'])->name('create.profil');
});

Route::post('/add', [appointmentController::class, 'store'])->name('appointment.add');
Route::get('/',[ClientController::class,'index'])->name('client.home');
Route::get('/products',[ClientController::class,'showProducts'])->name('client.products');
Route::get('/product/{medicament}',[ClientController::class,'showProduct'])->name('client.product');
Route::get('/products/permanance',[ClientController::class,'showPermanance'])->name('client.permanance');
Route::post('/products/Permanance',[ClientController::class,'getPermanance'])->name('client.getPermanance');


Route::post('/scan_code_barre', [MedicamentController::class, 'traiterRequete']);

