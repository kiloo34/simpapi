<?php

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

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use Admin\AlternatifController;
use Admin\KriteriaController;
// use Admin\KategoriController;
// use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\ProsesController;
use App\Http\Controllers\Admin\SubkriteriaController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PeternakController;

use App\Http\Controllers\Peternak\DashboardController as PeternakDashboard;
use App\Http\Controllers\Peternak\SapiController;
use App\Http\Controllers\Peternak\ProfilController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

// Route::get('/', Artikel::class)->name('landing');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function () {
        // dashboard
        Route::get('/', [AdminDashboard::class, 'index'])->name('admin.dashboard');

        // kriteria
        Route::resource('kriteria', KriteriaController::class);
        Route::get('kriteria/nilai/create', [App\Http\Controllers\Admin\KriteriaController::class, 'nilai'])->name('nilaikriteria.create');
        // Route::post('kriteria/nilai', [App\Http\Controllers\Admin\KriteriaController::class, 'submit'])->name('nilaikriteria.store');

        // subkriteria
        Route::get('kriteria/{id}/subkriteria', [SubkriteriaController::class, 'index'])->name('subkriteria.index');
        Route::get('kriteria/{id}/subkriteria/create', [SubkriteriaController::class, 'create'])->name('subkriteria.create');
        Route::post('kriteria/{id}/subkriteria', [SubkriteriaController::class, 'store'])->name('subkriteria.store');
        Route::get('kriteria/{id}/subkriteria/{subkriteriaId}/edit', [SubkriteriaController::class, 'edit'])->name('subkriteria.edit');
        Route::put('kriteria/{id}/subkriteria/{subkriteriaId}', [SubkriteriaController::class, 'update'])->name('subkriteria.update');
        Route::delete('kriteria/{id}/subkriteria/{subkriteriaId}',  [SubkriteriaController::class, 'destroy'])->name('subkriteria.destroy');
        Route::get('kriteria/{id}/subkriteria/nilai/create', [SubkriteriaController::class, 'nilai'])->name('nilaisubkriteria.create');

        // kategori
        Route::get('kriteria/{id}/kategori', [KategoriController::class, 'kriteria'])->name('kategorikriteria.index');
        Route::get('kriteria/{id}/kategori/create', [KategoriController::class, 'kriteriaCreate'])->name('kategorikriteria.create');
        Route::post('kriteria/{id}/kategori', [KategoriController::class, 'kriteriaStore'])->name('kategorikriteria.store');
        Route::get('kriteria/{id}/kategori/{kategoriId}/edit', [KategoriController::class, 'kriteriaEdit'])->name('kategorikriteria.edit');
        Route::put('kriteria/{id}/kategori/{kategoriId}', [KategoriController::class, 'kriteriaUpdate'])->name('kategorikriteria.update');
        Route::delete('kriteria/{id}/kategori/{kategoriId}',  [KategoriController::class, 'kriteriaDestroy'])->name('kategorikriteria.destroy');
        Route::get('kriteria/{id}/kategori/nilai/create', [KategoriController::class, 'nilaiKategoriKriteria'])->name('nilaikategorikriteria.create');

        Route::get('subkriteria/{id}/kategori', [KategoriController::class, 'subkriteria'])->name('kategorisubkriteria.index');
        Route::get('subkriteria/{id}/kategori/create', [KategoriController::class, 'subkriteriaCreate'])->name('kategorisubkriteria.create');
        Route::post('subkriteria/{id}/kategori', [KategoriController::class, 'subkriteriaStore'])->name('kategorisubkriteria.store');
        Route::get('subkriteria/{id}/kategori/{kategoriId}/edit', [KategoriController::class, 'subkriteriaEdit'])->name('kategorisubkriteria.edit');
        Route::put('subkriteria/{id}/kategori/{kategoriId}', [KategoriController::class, 'subkriteriaUpdate'])->name('kategorisubkriteria.update');
        Route::delete('subkriteria/{id}/kategori/{kategoriId}',  [KategoriController::class, 'subkriteriaDestroy'])->name('kategorisubkriteria.destroy');
        Route::get('subkriteria/{id}/kategori/nilai/create', [KategoriController::class, 'nilaiKategoriSubkriteria'])->name('nilaisubkategorikriteria.create');

        // alternatif
        Route::resource('alternatif', AlternatifController::class);
        Route::get('alternatif/{kode}/nilai/create', [App\Http\Controllers\Admin\AlternatifController::class, 'nilai'])->name('nilaialternatif.create');
        Route::get('alternatif/nilai/hasil', [App\Http\Controllers\Admin\AlternatifController::class, 'hasil'])->name('hasilalternatif.index');

        // perhitungan bobot
        Route::post('/bobotalternatif/{kode}', [ProsesController::class, 'alternatif'])->name('bobotalternatif.index');
        Route::post('/bobotkriteria', [ProsesController::class, 'kriteria'])->name('bobotkriteria.index');
        Route::post('/bobotsubkriteria/{id}', [ProsesController::class, 'subkriteria'])->name('bobotsubkriteria.index');
        Route::post('/bobotkategorikriteria/{id}', [ProsesController::class, 'kategoriKriteria'])->name('bobotkategorikriteria.index');
        Route::post('/bobotkategorisubkriteria/{id}', [ProsesController::class, 'kategoriSubkriteria'])->name('bobotkategorisubkriteria.index');

        // peternak
        Route::get('peternak', [PeternakController::class, 'index'])->name('peternak.index');
    });

    Route::group(['prefix' => 'peternak', 'middleware' => ['role:peternak']], function () {
        // dashboard
        Route::get('/', [PeternakDashboard::class, 'index'])->name('peternak.dashboard');
        //Sapi
        Route::get('/sapi', [SapiController::class, 'index'])->name('sapi.index');
        Route::get('/sapi/manual/create', [SapiController::class, 'manual'])->name('manual.create');
        Route::get('/sapi/rekomendasi/create', [SapiController::class, 'rekomendasi'])->name('rekomendasi.create');
        Route::post('/sapi/rekomendasi', [SapiController::class, 'hitung'])->name('hitung.index');
        Route::post('/sapi', [SapiController::class, 'store'])->name('sapi.store');
        // profil
        Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    });
});

Route::get('/home', 'HomeController@index')->name('home');
