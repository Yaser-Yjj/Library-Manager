<?php

namespace App\Models;

use CodeIgniter\Model;

class BorrowRequestModel extends Model
{
    protected $table            = 'borrow_requests';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'book_id', 'status', 'request_date', 'return_date'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getRequestsWithDetails()
    {
        return $this->select('borrow_requests.*, users.name as user_name, users.email as user_email, books.title as book_title')
                    ->join('users', 'users.id = borrow_requests.user_id')
                    ->join('books', 'books.id = borrow_requests.book_id')
                    ->orderBy('borrow_requests.created_at', 'DESC')
                    ->findAll();
    }

    public function getRequestsByUser(int $userId)
    {
        return $this->select('borrow_requests.*, books.title as book_title, books.author as book_author')
                    ->join('books', 'books.id = borrow_requests.book_id')
                    ->where('borrow_requests.user_id', $userId)
                    ->orderBy('borrow_requests.created_at', 'DESC')
                    ->findAll();
    }

    public function getPendingCount(): int
    {
        return $this->where('status', 'pending')->countAllResults();
    }
}
