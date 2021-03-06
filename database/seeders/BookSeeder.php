<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createBook(1, 'GRAMMAR', 9246);
        $this->createBook(2, 'VOCABULARY', 5859);
        $this->createBook(3, 'MISCELLANEOUS', 1056);
    }

    public function createBook($book, $topic, $questions_count) {
        DB::table('books')->insert([
            'book' => $book,
            'topic' => $topic,
            'questions_count' => $questions_count
        ]);
    }
}
