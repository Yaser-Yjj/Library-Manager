<?php

namespace App\Models;

use CodeIgniter\Model;

class PurchaseModel extends Model
{
    protected $table            = 'purchases';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'book_id', 'quantity', 'total_price', 'status'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getPurchasesWithDetails()
    {
        return $this->select('purchases.*, users.name as user_name, users.email as user_email, books.title as book_title')
                    ->join('users', 'users.id = purchases.user_id')
                    ->join('books', 'books.id = purchases.book_id')
                    ->orderBy('purchases.created_at', 'DESC')
                    ->findAll();
    }

    public function getPurchasesByUser(int $userId)
    {
        return $this->select('purchases.*, books.title as book_title, books.author as book_author')
                    ->join('books', 'books.id = purchases.book_id')
                    ->where('purchases.user_id', $userId)
                    ->orderBy('purchases.created_at', 'DESC')
                    ->findAll();
    }

    public function getPendingCount(): int
    {
        return $this->where('status', 'pending')->countAllResults();
    }
}
