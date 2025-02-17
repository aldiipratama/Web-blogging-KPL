<?php

class PostDashboard extends Controller
{
  public function index()
  {
    $data['judul'] = 'Post Dashboard';
    $this->view('pages/dashboard/pages/post/index', $data);
  }
}