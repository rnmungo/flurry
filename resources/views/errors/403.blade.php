@extends('errors::minimal')

@section('title', config('app.name', 'Due')." - 403")
@section('code', '403')
@section('message', "Acceso denegado para el usuario.")