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
                'description'    => 'A story of the mysteriously wealthy Jay Gatsby and his love for the beautiful Daisy Buchanan. Set in the Jazz Age on Long Island, it depicts narrator Nick Carraway\'s interactions with mysterious millionaire Jay Gatsby and Gatsby\'s obsession to reunite with his former lover, Daisy Buchanan.',
                'isbn'           => '978-0743273565',
                'price'          => 12.99,
                'stock_quantity' => 10,
                'cover_image'    => 'https://covers.openlibrary.org/b/isbn/9780743273565-L.jpg',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'title'          => 'To Kill a Mockingbird',
                'author'         => 'Harper Lee',
                'description'    => 'The unforgettable novel of a childhood in a sleepy Southern town and the crisis of conscience that rocked it. Through the young eyes of Scout and Jem Finch, Harper Lee explores with exuberant humour the irrationality of adult attitudes to race and class in the Deep South of the 1930s.',
                'isbn'           => '978-0061120084',
                'price'          => 14.99,
                'stock_quantity' => 8,
                'cover_image'    => 'https://covers.openlibrary.org/b/isbn/9780061120084-L.jpg',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'title'          => '1984',
                'author'         => 'George Orwell',
                'description'    => 'A dystopian social science fiction novel and cautionary tale about the dangers of totalitarianism. Written in 1949, this novel depicts a totalitarian future society where critical thought is suppressed under a totalitarian regime.',
                'isbn'           => '978-0451524935',
                'price'          => 11.99,
                'stock_quantity' => 15,
                'cover_image'    => 'https://covers.openlibrary.org/b/isbn/9780451524935-L.jpg',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'title'          => 'Pride and Prejudice',
                'author'         => 'Jane Austen',
                'description'    => 'A romantic novel of manners that follows the character development of Elizabeth Bennet, the dynamic protagonist who learns about the repercussions of hasty judgments and comes to appreciate the difference between superficial goodness and actual goodness.',
                'isbn'           => '978-0141439518',
                'price'          => 9.99,
                'stock_quantity' => 12,
                'cover_image'    => 'https://covers.openlibrary.org/b/isbn/9780141439518-L.jpg',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'title'          => 'The Catcher in the Rye',
                'author'         => 'J.D. Salinger',
                'description'    => 'The story of Holden Caulfield, a teenager alienated from society and disillusioned with the adult world. The novel became an immediate popular success. It is frequently cited as one of the best novels of the 20th century.',
                'isbn'           => '978-0316769488',
                'price'          => 13.99,
                'stock_quantity' => 6,
                'cover_image'    => 'https://covers.openlibrary.org/b/isbn/9780316769488-L.jpg',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'title'          => 'Harry Potter and the Sorcerer\'s Stone',
                'author'         => 'J.K. Rowling',
                'description'    => 'Harry Potter has never been the star of a Quidditch team, scoring points while riding a broom far above the ground. He knows no spells, has never helped to hatch a dragon, and has never worn a cloak of invisibility. All he knows is a miserable life with the Dursleys.',
                'isbn'           => '978-0590353427',
                'price'          => 15.99,
                'stock_quantity' => 20,
                'cover_image'    => 'https://covers.openlibrary.org/b/isbn/9780590353427-L.jpg',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'title'          => 'The Hobbit',
                'author'         => 'J.R.R. Tolkien',
                'description'    => 'Bilbo Baggins is a hobbit who enjoys a comfortable, unambitious life, rarely traveling any farther than his pantry or cellar. But his contentment is disturbed when the wizard Gandalf and a company of dwarves arrive on his doorstep.',
                'isbn'           => '978-0547928227',
                'price'          => 14.99,
                'stock_quantity' => 15,
                'cover_image'    => 'https://covers.openlibrary.org/b/isbn/9780547928227-L.jpg',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'title'          => 'The Da Vinci Code',
                'author'         => 'Dan Brown',
                'description'    => 'While in Paris, Harvard symbologist Robert Langdon is awakened by a phone call in the dead of the night. The elderly curator of the Louvre has been murdered inside the museum, his body covered in baffling symbols.',
                'isbn'           => '978-0307474278',
                'price'          => 16.99,
                'stock_quantity' => 12,
                'cover_image'    => 'https://covers.openlibrary.org/b/isbn/9780307474278-L.jpg',
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
