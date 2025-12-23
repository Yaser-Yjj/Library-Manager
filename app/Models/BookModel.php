<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table            = 'books';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'author', 'description', 'isbn', 'price', 'stock_quantity'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'title'          => 'required|min_length[1]|max_length[255]',
        'author'         => 'required|min_length[1]|max_length[100]',
        'price'          => 'required|numeric',
        'stock_quantity' => 'required|integer',
    ];

    protected $skipValidation = false;

    public function getAvailableBooks()
    {
        return $this->where('stock_quantity >', 0)->findAll();
    }

    public function reduceStock(int $bookId, int $quantity = 1): bool
    {
        $book = $this->find($bookId);
        if ($book && $book['stock_quantity'] >= $quantity) {
            return $this->update($bookId, [
                'stock_quantity' => $book['stock_quantity'] - $quantity
            ]);
        }
        return false;
    }

    public function increaseStock(int $bookId, int $quantity = 1): bool
    {
        $book = $this->find($bookId);
        if ($book) {
            return $this->update($bookId, [
                'stock_quantity' => $book['stock_quantity'] + $quantity
            ]);
        }
        return false;
    }
}
