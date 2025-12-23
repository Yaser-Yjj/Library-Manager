<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\UserModel;
use App\Models\BorrowRequestModel;
use App\Models\PurchaseModel;

class Admin extends BaseController
{
    protected $bookModel;
    protected $userModel;
    protected $borrowRequestModel;
    protected $purchaseModel;

    public function __construct()
    {
        $this->bookModel = new BookModel();
        $this->userModel = new UserModel();
        $this->borrowRequestModel = new BorrowRequestModel();
        $this->purchaseModel = new PurchaseModel();
    }

    public function dashboard()
    {
        $data = [
            'totalBooks'           => $this->bookModel->countAll(),
            'totalUsers'           => $this->userModel->where('role', 'user')->countAllResults(),
            'pendingBorrows'       => $this->borrowRequestModel->getPendingCount(),
            'pendingPurchases'     => $this->purchaseModel->getPendingCount(),
        ];
        return view('admin/dashboard', $data);
    }

    public function books()
    {
        $data = [
            'books' => $this->bookModel->findAll(),
        ];
        return view('admin/books/index', $data);
    }

    public function addBook()
    {
        return view('admin/books/add');
    }

    public function storeBook()
    {
        $data = [
            'title'          => $this->request->getPost('title'),
            'author'         => $this->request->getPost('author'),
            'description'    => $this->request->getPost('description'),
            'isbn'           => $this->request->getPost('isbn'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
        ];

        if ($this->bookModel->insert($data)) {
            return redirect()->to(base_url('admin/books'))->with('success', 'Book added successfully!');
        }

        return redirect()->back()->with('error', 'Failed to add book.')->withInput();
    }

    public function editBook($id)
    {
        $book = $this->bookModel->find($id);
        
        if (!$book) {
            return redirect()->to(base_url('admin/books'))->with('error', 'Book not found.');
        }

        $data = [
            'book' => $book,
        ];
        return view('admin/books/edit', $data);
    }

    public function updateBook($id)
    {
        $book = $this->bookModel->find($id);
        
        if (!$book) {
            return redirect()->to(base_url('admin/books'))->with('error', 'Book not found.');
        }

        $data = [
            'title'          => $this->request->getPost('title'),
            'author'         => $this->request->getPost('author'),
            'description'    => $this->request->getPost('description'),
            'isbn'           => $this->request->getPost('isbn'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
        ];

        if ($this->bookModel->update($id, $data)) {
            return redirect()->to(base_url('admin/books'))->with('success', 'Book updated successfully!');
        }

        return redirect()->back()->with('error', 'Failed to update book.')->withInput();
    }

    public function deleteBook($id)
    {
        if ($this->bookModel->delete($id)) {
            return redirect()->to(base_url('admin/books'))->with('success', 'Book deleted successfully!');
        }

        return redirect()->to(base_url('admin/books'))->with('error', 'Failed to delete book.');
    }

    public function borrowRequests()
    {
        $data = [
            'requests' => $this->borrowRequestModel->getRequestsWithDetails(),
        ];
        return view('admin/borrow_requests', $data);
    }

    public function updateBorrowStatus($id)
    {
        $status = $this->request->getPost('status');
        
        if ($this->borrowRequestModel->update($id, ['status' => $status])) {
            if ($status === 'approved') {
                $request = $this->borrowRequestModel->find($id);
                $this->bookModel->reduceStock($request['book_id']);
            }
            if ($status === 'returned') {
                $request = $this->borrowRequestModel->find($id);
                $this->bookModel->increaseStock($request['book_id']);
                $this->borrowRequestModel->update($id, ['return_date' => date('Y-m-d H:i:s')]);
            }
            return redirect()->to(base_url('admin/borrow-requests'))->with('success', 'Status updated successfully!');
        }

        return redirect()->to(base_url('admin/borrow-requests'))->with('error', 'Failed to update status.');
    }

    public function purchases()
    {
        $data = [
            'purchases' => $this->purchaseModel->getPurchasesWithDetails(),
        ];
        return view('admin/purchases', $data);
    }

    public function updatePurchaseStatus($id)
    {
        $status = $this->request->getPost('status');
        
        if ($this->purchaseModel->update($id, ['status' => $status])) {
            if ($status === 'completed') {
                $purchase = $this->purchaseModel->find($id);
                $this->bookModel->reduceStock($purchase['book_id'], $purchase['quantity']);
            }
            return redirect()->to(base_url('admin/purchases'))->with('success', 'Status updated successfully!');
        }

        return redirect()->to(base_url('admin/purchases'))->with('error', 'Failed to update status.');
    }

    public function users()
    {
        $data = [
            'users' => $this->userModel->where('role', 'user')->findAll(),
        ];
        return view('admin/users', $data);
    }
}
