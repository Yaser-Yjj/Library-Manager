<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        $books = [
            [
                'title'          => 'The Great Gatsby',
                'author'         => 'F. Scott Fitzgerald',
                'description'    => 'A story of the mysteriously wealthy Jay Gatsby and his love for the beautiful Daisy Buchanan.',
                'isbn'           => '978-0743273565',
                'price'          => 12.99,
                'stock_quantity' => 10,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'title'          => 'To Kill a Mockingbird',
                'author'         => 'Harper Lee',
                'description'    => 'The unforgettable novel of a childhood in a sleepy Southern town and the crisis of conscience that rocked it.',
                'isbn'           => '978-0061120084',
                'price'          => 14.99,
                'stock_quantity' => 8,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'title'          => '1984',
                'author'         => 'George Orwell',
                'description'    => 'A dystopian social science fiction novel and cautionary tale about the dangers of totalitarianism.',
                'isbn'           => '978-0451524935',
                'price'          => 11.99,
                'stock_quantity' => 15,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'title'          => 'Pride and Prejudice',
                'author'         => 'Jane Austen',
                'description'    => 'A romantic novel of manners that follows the character development of Elizabeth Bennet.',
                'isbn'           => '978-0141439518',
                'price'          => 9.99,
                'stock_quantity' => 12,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'title'          => 'The Catcher in the Rye',
                'author'         => 'J.D. Salinger',
                'description'    => 'The story of Holden Caulfield, a teenager alienated from society and disillusioned with the adult world.',
                'isbn'           => '978-0316769488',
                'price'          => 13.99,
                'stock_quantity' => 6,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($books as $book) {
            $this->db->table('books')->insert($book);
        }

        echo "Sample books added!\n";
    }
}
