<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\UserModel;

class Home extends BaseController
{
    public function index(): string
    {
        $bookModel = new BookModel();
        $userModel = new UserModel();
        
        $data = [
            'title' => 'BookHub - Your Library Destination',
            'totalBooks' => $bookModel->countAll(),
            'totalUsers' => $userModel->where('role', 'user')->countAllResults(),
            'featuredBooks' => $bookModel->orderBy('created_at', 'DESC')->findAll(4),
        ];
        
        return view('home/index', $data);
    }
}
