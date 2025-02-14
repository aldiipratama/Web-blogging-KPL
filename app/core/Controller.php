<?php

class Controller
{
  public function view($view, $data = [])
  {
    include '../resources/views/' . $view . '.php';
  }

  public function model($model)
  {
    include '../app/models/' . $model . '.php';
    return new $model;
  }
}