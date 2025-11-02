<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
     return view('Home');
 })->name('home');

Route::get('/3d-rendering', function () {
     return view('Service_3d_rendering');
 })->name('services.3d_rendering');
Route::get('/services/architectural-design', function () {
     return view('Service_architectural_design');
 })->name('services.architectural_design');
Route::get('/services/bim', function () {
     return view('Service_bim');
 })->name('services.bim');
Route::get('/services/estimation', function () {
     return view('Service_estimation');
 })->name('services.estimation');
Route::get('/services/interior-design', function () {
     return view('Service_interior_design');
 })->name('services.interior_design');
Route::get('/services/project-management', function () {
     return view('Service_project_management');
 })->name('services.project_management');
Route::get('/services/structural-design', function () {
     return view('Service_structural_design');
 })->name('services.structural_design');

 