<?php

declare(strict_types=1);

// Core

$container->add("Pdo", PDO::class)
    ->addArgument("mysql:dbname={$_ENV["DB_NAME"]};host={$_ENV["DB_HOST"]}")
    ->addArgument($_ENV["DB_USER"])
    ->addArgument($_ENV["DB_PASS"])
    ->addArgument([]);
$container->add("Database", Chinook\Database\PdoDatabase::class)
    ->addArgument("Pdo");

// Album

$container->add("AlbumRepository", Chinook\Album\AlbumRepository::class)
    ->addArgument("Database");
$container->add("AlbumService", Chinook\Album\AlbumService::class)
    ->addArgument("AlbumRepository");
$container->add(Chinook\Album\AlbumController::class)
    ->addArgument("AlbumService");

// Artist

$container->add("ArtistRepository", Chinook\Artist\ArtistRepository::class)
    ->addArgument("Database");
$container->add("ArtistService", Chinook\Artist\ArtistService::class)
    ->addArgument("ArtistRepository");
$container->add(Chinook\Artist\ArtistController::class)
    ->addArgument("ArtistService");

// Customer

$container->add("CustomerRepository", Chinook\Customer\CustomerRepository::class)
    ->addArgument("Database");
$container->add("CustomerService", Chinook\Customer\CustomerService::class)
    ->addArgument("CustomerRepository");
$container->add(Chinook\Customer\CustomerController::class)
    ->addArgument("CustomerService");

// Employee

$container->add("EmployeeRepository", Chinook\Employee\EmployeeRepository::class)
    ->addArgument("Database");
$container->add("EmployeeService", Chinook\Employee\EmployeeService::class)
    ->addArgument("EmployeeRepository");
$container->add(Chinook\Employee\EmployeeController::class)
    ->addArgument("EmployeeService");

// Genre

$container->add("GenreRepository", Chinook\Genre\GenreRepository::class)
    ->addArgument("Database");
$container->add("GenreService", Chinook\Genre\GenreService::class)
    ->addArgument("GenreRepository");
$container->add(Chinook\Genre\GenreController::class)
    ->addArgument("GenreService");

// Invoice

$container->add("InvoiceRepository", Chinook\Invoice\InvoiceRepository::class)
    ->addArgument("Database");
$container->add("InvoiceService", Chinook\Invoice\InvoiceService::class)
    ->addArgument("InvoiceRepository");
$container->add(Chinook\Invoice\InvoiceController::class)
    ->addArgument("InvoiceService");

// Invoiceline

$container->add("InvoicelineRepository", Chinook\Invoiceline\InvoicelineRepository::class)
    ->addArgument("Database");
$container->add("InvoicelineService", Chinook\Invoiceline\InvoicelineService::class)
    ->addArgument("InvoicelineRepository");
$container->add(Chinook\Invoiceline\InvoicelineController::class)
    ->addArgument("InvoicelineService");

// Mediatype

$container->add("MediatypeRepository", Chinook\Mediatype\MediatypeRepository::class)
    ->addArgument("Database");
$container->add("MediatypeService", Chinook\Mediatype\MediatypeService::class)
    ->addArgument("MediatypeRepository");
$container->add(Chinook\Mediatype\MediatypeController::class)
    ->addArgument("MediatypeService");

// Playlist

$container->add("PlaylistRepository", Chinook\Playlist\PlaylistRepository::class)
    ->addArgument("Database");
$container->add("PlaylistService", Chinook\Playlist\PlaylistService::class)
    ->addArgument("PlaylistRepository");
$container->add(Chinook\Playlist\PlaylistController::class)
    ->addArgument("PlaylistService");

// Playlisttrack

$container->add("PlaylisttrackRepository", Chinook\Playlisttrack\PlaylisttrackRepository::class)
    ->addArgument("Database");
$container->add("PlaylisttrackService", Chinook\Playlisttrack\PlaylisttrackService::class)
    ->addArgument("PlaylisttrackRepository");
$container->add(Chinook\Playlisttrack\PlaylisttrackController::class)
    ->addArgument("PlaylisttrackService");

// Track

$container->add("TrackRepository", Chinook\Track\TrackRepository::class)
    ->addArgument("Database");
$container->add("TrackService", Chinook\Track\TrackService::class)
    ->addArgument("TrackRepository");
$container->add(Chinook\Track\TrackController::class)
    ->addArgument("TrackService");

