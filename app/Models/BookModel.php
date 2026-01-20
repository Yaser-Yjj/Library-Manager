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
    protected $allowedFields    = ['title', 'author', 'description', 'isbn', 'price', 'stock_quantity', 'cover_image'];

    /**
     * Get book cover URL with fallback
     * Priority: Local asset -> External URL -> Default placeholder
     */
    public static function getCoverUrl(?string $coverImage, string $title = 'Book'): string
    {
        // If cover_image is set
        if (!empty($coverImage)) {
            // Check if it's a URL (external image)
            if (filter_var($coverImage, FILTER_VALIDATE_URL)) {
                return $coverImage;
            }
            
            // Check if local file exists
            $localPath = FCPATH . 'uploads/covers/' . $coverImage;
            if (file_exists($localPath)) {
                return base_url('uploads/covers/' . $coverImage);
            }
        }
        
        // Return a placeholder with book initials
        $initials = strtoupper(substr($title, 0, 2));
        return 'https://placehold.co/300x450/667eea/ffffff?text=' . urlencode($initials);
    }

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
