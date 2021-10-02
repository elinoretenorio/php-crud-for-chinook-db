<?php

declare(strict_types=1);

$router->get("/album", "Chinook\Album\AlbumController::getAll");
$router->post("/album", "Chinook\Album\AlbumController::insert");
$router->group("/album", function ($router) {
    $router->get("/{Album_Id:number}", "Chinook\Album\AlbumController::get");
    $router->post("/{Album_Id:number}", "Chinook\Album\AlbumController::update");
    $router->delete("/{Album_Id:number}", "Chinook\Album\AlbumController::delete");
});

$router->get("/artist", "Chinook\Artist\ArtistController::getAll");
$router->post("/artist", "Chinook\Artist\ArtistController::insert");
$router->group("/artist", function ($router) {
    $router->get("/{Artist_Id:number}", "Chinook\Artist\ArtistController::get");
    $router->post("/{Artist_Id:number}", "Chinook\Artist\ArtistController::update");
    $router->delete("/{Artist_Id:number}", "Chinook\Artist\ArtistController::delete");
});

$router->get("/customer", "Chinook\Customer\CustomerController::getAll");
$router->post("/customer", "Chinook\Customer\CustomerController::insert");
$router->group("/customer", function ($router) {
    $router->get("/{Customer_Id:number}", "Chinook\Customer\CustomerController::get");
    $router->post("/{Customer_Id:number}", "Chinook\Customer\CustomerController::update");
    $router->delete("/{Customer_Id:number}", "Chinook\Customer\CustomerController::delete");
});

$router->get("/employee", "Chinook\Employee\EmployeeController::getAll");
$router->post("/employee", "Chinook\Employee\EmployeeController::insert");
$router->group("/employee", function ($router) {
    $router->get("/{Employee_Id:number}", "Chinook\Employee\EmployeeController::get");
    $router->post("/{Employee_Id:number}", "Chinook\Employee\EmployeeController::update");
    $router->delete("/{Employee_Id:number}", "Chinook\Employee\EmployeeController::delete");
});

$router->get("/genre", "Chinook\Genre\GenreController::getAll");
$router->post("/genre", "Chinook\Genre\GenreController::insert");
$router->group("/genre", function ($router) {
    $router->get("/{Genre_Id:number}", "Chinook\Genre\GenreController::get");
    $router->post("/{Genre_Id:number}", "Chinook\Genre\GenreController::update");
    $router->delete("/{Genre_Id:number}", "Chinook\Genre\GenreController::delete");
});

$router->get("/invoice", "Chinook\Invoice\InvoiceController::getAll");
$router->post("/invoice", "Chinook\Invoice\InvoiceController::insert");
$router->group("/invoice", function ($router) {
    $router->get("/{Invoice_Id:number}", "Chinook\Invoice\InvoiceController::get");
    $router->post("/{Invoice_Id:number}", "Chinook\Invoice\InvoiceController::update");
    $router->delete("/{Invoice_Id:number}", "Chinook\Invoice\InvoiceController::delete");
});

$router->get("/invoiceline", "Chinook\Invoiceline\InvoicelineController::getAll");
$router->post("/invoiceline", "Chinook\Invoiceline\InvoicelineController::insert");
$router->group("/invoiceline", function ($router) {
    $router->get("/{Invoice_Line_Id:number}", "Chinook\Invoiceline\InvoicelineController::get");
    $router->post("/{Invoice_Line_Id:number}", "Chinook\Invoiceline\InvoicelineController::update");
    $router->delete("/{Invoice_Line_Id:number}", "Chinook\Invoiceline\InvoicelineController::delete");
});

$router->get("/mediatype", "Chinook\Mediatype\MediatypeController::getAll");
$router->post("/mediatype", "Chinook\Mediatype\MediatypeController::insert");
$router->group("/mediatype", function ($router) {
    $router->get("/{Media_Type_Id:number}", "Chinook\Mediatype\MediatypeController::get");
    $router->post("/{Media_Type_Id:number}", "Chinook\Mediatype\MediatypeController::update");
    $router->delete("/{Media_Type_Id:number}", "Chinook\Mediatype\MediatypeController::delete");
});

$router->get("/playlist", "Chinook\Playlist\PlaylistController::getAll");
$router->post("/playlist", "Chinook\Playlist\PlaylistController::insert");
$router->group("/playlist", function ($router) {
    $router->get("/{Playlist_Id:number}", "Chinook\Playlist\PlaylistController::get");
    $router->post("/{Playlist_Id:number}", "Chinook\Playlist\PlaylistController::update");
    $router->delete("/{Playlist_Id:number}", "Chinook\Playlist\PlaylistController::delete");
});

$router->get("/playlisttrack", "Chinook\Playlisttrack\PlaylisttrackController::getAll");
$router->post("/playlisttrack", "Chinook\Playlisttrack\PlaylisttrackController::insert");
$router->group("/playlisttrack", function ($router) {
    $router->get("/{Playlist_Track_Id:number}", "Chinook\Playlisttrack\PlaylisttrackController::get");
    $router->post("/{Playlist_Track_Id:number}", "Chinook\Playlisttrack\PlaylisttrackController::update");
    $router->delete("/{Playlist_Track_Id:number}", "Chinook\Playlisttrack\PlaylisttrackController::delete");
});

$router->get("/track", "Chinook\Track\TrackController::getAll");
$router->post("/track", "Chinook\Track\TrackController::insert");
$router->group("/track", function ($router) {
    $router->get("/{Track_Id:number}", "Chinook\Track\TrackController::get");
    $router->post("/{Track_Id:number}", "Chinook\Track\TrackController::update");
    $router->delete("/{Track_Id:number}", "Chinook\Track\TrackController::delete");
});

