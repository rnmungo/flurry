@extends('errors::minimal')

@section('title', config('app.name', 'Due')." - Error")
@section('code', '404')
@section('message', "Página no encontrada")