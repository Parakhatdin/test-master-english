<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $this->book1Parts();
            $this->book2Parts();
            $this->book3Parts();
        });
    }

    public function book1Parts()
    {
        $book1_id = DB::table('books')->where("book", "=", 1)->first()->id;
        $this->add(
            "A",
            $book1_id,
            "14 Elementary tests, 14 Pre-Intermediate tests, 8 Intermediate tests.",
            "Each test is specified on different grammar topics. (1976 questions-) 1-2"
        );
        $this->add(
            "B",
            $book1_id,
            "14 tests including Elementary, Pre-intermediate, Intermediate and Upper intermediate level grammar tests.",
            "Every test is focused on a different grammar topic. (2452 questions) 1-2-3"
        );
        $this->add(
            "C",
            $book1_id,
            "16 Multi-level grammar tests.",
            "Each test is specified on a different grammar topic. (1418 questions) 4"
        );
        $this->add(
            "D",
            $book1_id,
            "20 perfect multi-level grammar tests for assessment.",
            "(2000 questions) 4"
        );
        $this->add(
            "E",
            $book1_id,
            "6 Elementary, 5 Intermediate, 3 Advanced grammar tests.",
            "The formats of the tests are similar and the level gradually increases. (1400 questions) 1-2-3"
        );
    }

    public function book2Parts()
    {
        $book2_id = DB::table('books')->where("book", "=", 2)->first()->id;
        $this->add(
            "A",
            $book2_id,
            "A wide range of vocabulary tests for new learners. Compiled from various resources.",
            "(1657 questions) 1-2"
        );
        $this->add(
            "B",
            $book2_id,
            "A rich collection of vocabulary tests for intermediate and upper intermediate levels.",
            "(1988 questions) 2-3"
        );
        $this->add(
            "C",
            $book2_id,
            "An assortment of phrasal verbs.",
            "(714 questions) 3"
        );
        $this->add(
            "D",
            $book2_id,
            "25 upper level vocabulary tests.",
            "(1000 questions) 3"
        );
        $this->add(
            "E",
            $book2_id,
            "Advanced level synonym questions.",
            "(500 questions) 3"
        );
    }

    public function book3Parts()
    {
        $book3_id = DB::table('books')->where("book", "=", 3)->first()->id;
        $this->add(
            "Book 3",
            $book3_id,
            "Miscellaneous: Includes questions for a better reading comprehension, dialogue build, colloquial and idiomatic expressions. Helps you understand and use English perfectly.",
            "(1056 questions) 4"
        );
    }

    public function add($part, $book_id, $main_info, $second_info)
    {
        DB::table('parts')->insert([
            "part" => $part,
            "book_id" => $book_id,
            "main_info" => $main_info,
            "second_info" => $second_info
        ]);
    }
}
