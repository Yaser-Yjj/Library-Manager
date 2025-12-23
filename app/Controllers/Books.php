<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\BorrowRequestModel;
use App\Models\PurchaseModel;

class Books extends BaseController
{
    protected $bookModel;
    protected $borrowRequestModel;
    protected $purchaseModel;
    protected $session;

    public function __construct()
    {
        $this->bookModel = new BookModel();
        $this->borrowRequestModel = new BorrowRequestModel();
        $this->purchaseModel = new PurchaseModel();
        $this->session = session();
    }

    public function index()
    {
        $data = [
            'books' => $this->bookModel->findAll(),
        ];
        return view('books/index', $data);
    }

    public function show($id)
    {
        $book = $this->bookModel->find($id);
        
        if (!$book) {
            return redirect()->to(base_url('books'))->with('error', 'Book not found.');
        }

        $data = [
            'book' => $book,
        ];
        return view('books/show', $data);
    }

    public function borrow($bookId)
    {
        $book = $this->bookModel->find($bookId);
        
        if (!$book) {
            return redirect()->to(base_url('books'))->with('error', 'Book not found.');
        }

        if ($book['stock_quantity'] < 1) {
            return redirect()->to(base_url('books'))->with('error', 'This book is currently out of stock.');
        }

        $data = [
            'user_id'      => $this->session->get('userId'),
            'book_id'      => $bookId,
            'status'       => 'pending',
            'request_date' => date('Y-m-d H:i:s'),
        ];

        if ($this->borrowRequestModel->insert($data)) {
            return redirect()->to(base_url('books'))->with('success', 'Borrow request submitted successfully!');
        }

        return redirect()->to(base_url('books'))->with('error', 'Failed to submit borrow request.');
    }

    public function purchase($bookId)
    {
        $book = $this->bookModel->find($bookId);
        
        if (!$book) {
            return redirect()->to(base_url('books'))->with('error', 'Book not found.');
        }

        if ($book['stock_quantity'] < 1) {
            return redirect()->to(base_url('books'))->with('error', 'This book is currently out of stock.');
        }

        $quantity = 1;
        $data = [
            'user_id'     => $this->session->get('userId'),
            'book_id'     => $bookId,
            'quantity'    => $quantity,
            'total_price' => $book['price'] * $quantity,
            'status'      => 'pending',
        ];

        if ($this->purchaseModel->insert($data)) {
            return redirect()->to(base_url('books'))->with('success', 'Purchase request submitted successfully!');
        }

        return redirect()->to(base_url('books'))->with('error', 'Failed to submit purchase request.');
    }

    public function myBorrows()
    {
        $data = [
            'requests' => $this->borrowRequestModel->getRequestsByUser($this->session->get('userId')),
        ];
        return view('books/my_borrows', $data);
    }

    public function myPurchases()
    {
        $data = [
            'purchases' => $this->purchaseModel->getPurchasesByUser($this->session->get('userId')),
        ];
        return view('books/my_purchases', $data);
    }
}
