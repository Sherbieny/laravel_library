<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\User;
use App\Models\Category;

class BookSeeder extends Seeder
{
    public function run()
    {
        // Clear existing records
        Book::query()->delete();

        $user = User::where('email', 'test@example.com')->first();
        $secondUser = User::where('email', 'test2@example.com')->first();

        $category = Category::where('name', 'Fantasy')->first();

        $malazanBooks = [
            [
                'title' => 'Gardens of the Moon',
                'author' => 'Steven Erikson',
                'description' => 'The opening chapter in the epic fantasy series, where ancient sorceries clash with rising empires.',
                'publication_year' => 1999,
                'category_id' => $category->id ?? null,
                'user_id' => $secondUser->id,
            ],
            [
                'title' => 'Deadhouse Gates',
                'author' => 'Steven Erikson',
                'description' => 'A tale of a brutal journey across the desert and rebellion in the Seven Cities.',
                'publication_year' => 2000,
                'category_id' => $category->id ?? null,
                'user_id' => $user->id,
            ],
            [
                'title' => 'Memories of Ice',
                'author' => 'Steven Erikson',
                'description' => 'An ancient alliance formed to battle the Pannion Domin’s dark god.',
                'publication_year' => 2001,
                'category_id' => $category->id ?? null,
                'user_id' => $user->id,
            ],
            [
                'title' => 'House of Chains',
                'author' => 'Steven Erikson',
                'description' => 'An approaching apocalypse, with new powers and betrayals.',
                'publication_year' => 2002,
                'category_id' => $category->id ?? null,
                'user_id' => $user->id,
            ],
            [
                'title' => 'Midnight Tides',
                'author' => 'Steven Erikson',
                'description' => 'A story of empires and tribes on the brink of war in a different continent.',
                'publication_year' => 2004,
                'category_id' => $category->id ?? null,
                'user_id' => $user->id,
            ],
            [
                'title' => 'The Bonehunters',
                'author' => 'Steven Erikson',
                'description' => 'The aftermath of rebellion and new forces converging on the world.',
                'publication_year' => 2006,
                'category_id' => $category->id ?? null,
                'user_id' => $user->id,
            ],
            [
                'title' => 'Reaper\'s Gale',
                'author' => 'Steven Erikson',
                'description' => 'A tale of the Letherii Empire clashing with the Tiste Edur.',
                'publication_year' => 2007,
                'category_id' => $category->id ?? null,
                'user_id' => $user->id,
            ],
            [
                'title' => 'Toll the Hounds',
                'author' => 'Steven Erikson',
                'description' => 'The return to Darujhistan and the gathering of old heroes.',
                'publication_year' => 2008,
                'category_id' => $category->id ?? null,
                'user_id' => $user->id,
            ],
            [
                'title' => 'Dust of Dreams',
                'author' => 'Steven Erikson',
                'description' => 'The beginning of the epic conclusion as armies converge for the last conflict.',
                'publication_year' => 2009,
                'category_id' => $category->id ?? null,
                'user_id' => $user->id,
            ],
            [
                'title' => 'The Crippled God',
                'author' => 'Steven Erikson',
                'description' => 'The final confrontation and the resolution of the Malazan tale.',
                'publication_year' => 2011,
                'category_id' => $category->id ?? null,
                'user_id' => $user->id,
            ],
        ];

        $firstLawBooks = [
            [
                'title' => 'The Blade Itself',
                'author' => 'Joe Abercrombie',
                'description' => 'The first book in The First Law series, where heroes, barbarians, and villains collide in an unforgiving world.',
                'publication_year' => 2006,
                'category_id' => $category->id ?? null,
                'user_id' => $user->id,
            ],
            [
                'title' => 'Before They Are Hanged',
                'author' => 'Joe Abercrombie',
                'description' => 'A tale of treachery and revenge, the second book in The First Law series.',
                'publication_year' => 2007,
                'category_id' => $category->id ?? null,
                'user_id' => $user->id,
            ],
            [
                'title' => 'Last Argument of Kings',
                'author' => 'Joe Abercrombie',
                'description' => 'The final book of the trilogy where battles are fought, and a kingdom’s fate is decided.',
                'publication_year' => 2008,
                'category_id' => $category->id ?? null,
                'user_id' => $user->id,
            ],
            [
                'title' => 'Best Served Cold',
                'author' => 'Joe Abercrombie',
                'description' => 'A stand-alone novel in The First Law universe, where vengeance is taken to new levels.',
                'publication_year' => 2009,
                'category_id' => $category->id ?? null,
                'user_id' => $user->id,
            ],
            [
                'title' => 'The Heroes',
                'author' => 'Joe Abercrombie',
                'description' => 'Another stand-alone novel, detailing a three-day battle that will determine the future of the North.',
                'publication_year' => 2011,
                'category_id' => $category->id ?? null,
                'user_id' => $user->id,
            ],
            [
                'title' => 'Red Country',
                'author' => 'Joe Abercrombie',
                'description' => 'A story of frontier justice and old debts in The First Law world.',
                'publication_year' => 2012,
                'category_id' => $category->id ?? null,
                'user_id' => $user->id,
            ],
            [
                'title' => 'A Little Hatred',
                'author' => 'Joe Abercrombie',
                'description' => 'The first book in the Age of Madness trilogy, a new generation faces industrial advances and political upheaval.',
                'publication_year' => 2019,
                'category_id' => $category->id ?? null,
                'user_id' => $user->id,
            ],
            [
                'title' => 'The Trouble with Peace',
                'author' => 'Joe Abercrombie',
                'description' => 'The Age of Madness continues with betrayal and shifting alliances.',
                'publication_year' => 2020,
                'category_id' => $category->id ?? null,
                'user_id' => $user->id,
            ],
            [
                'title' => 'The Wisdom of Crowds',
                'author' => 'Joe Abercrombie',
                'description' => 'The Age of Madness trilogy concludes with revolutionary fervor and chaos.',
                'publication_year' => 2021,
                'category_id' => $category->id ?? null,
                'user_id' => $user->id,
            ],
        ];

        $fictionBooks = [
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'description' => 'A novel about racial injustice in the American South.',
                'publication_year' => 1960,
                'category_id' => Category::where('name', 'Fiction')->first()->id ?? null,
                'user_id' => $secondUser->id,
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'description' => 'A dystopian novel about a totalitarian regime that practices extreme surveillance and control.',
                'publication_year' => 1949,
                'category_id' => Category::where('name', 'Fiction')->first()->id ?? null,
                'user_id' => $user->id,
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'description' => 'A classic novel about love and social standing in 19th-century England.',
                'publication_year' => 1913,
                'category_id' => Category::where('name', 'Fiction')->first()->id ?? null,
                'user_id' => $secondUser->id,
            ],
        ];

        $nonFictionBooks = [
            [
                'title' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'description' => 'An exploration of the history of humankind from the Stone Age to the modern era.',
                'publication_year' => 2011,
                'category_id' => Category::where('name', 'Non-Fiction')->first()->id ?? null,
                'user_id' => $secondUser->id,
            ],
            [
                'title' => 'Educated',
                'author' => 'Tara Westover',
                'description' => 'A memoir about a woman who grows up in a strict and abusive household in rural Idaho and eventually escapes to learn about the wider world through education.',
                'publication_year' => 2018,
                'category_id' => Category::where('name', 'Non-Fiction')->first()->id ?? null,
                'user_id' => $user->id,
            ],
            [
                'title' => 'The Immortal Life of Henrietta Lacks',
                'author' => 'Rebecca Skloot',
                'description' => 'The story of Henrietta Lacks and how her cells contributed to countless medical breakthroughs.',
                'publication_year' => 2010,
                'category_id' => Category::where('name', 'Non-Fiction')->first()->id ?? null,
                'user_id' => $secondUser->id,
            ],
        ];

        $scienceFictionBooks = [
            [
                'title' => 'Dune',
                'author' => 'Frank Herbert',
                'description' => 'A science fiction epic set on the desert planet Arrakis, focusing on politics, religion, and ecology.',
                'publication_year' => 1965,
                'category_id' => Category::where('name', 'Science Fiction')->first()->id ?? null,
                'user_id' => $secondUser->id,
            ],
            [
                'title' => 'Neuromancer',
                'author' => 'William Gibson',
                'description' => 'A cyberpunk novel that introduced many elements of the genre, including AI, cyberspace, and mega-corporations.',
                'publication_year' => 1984,
                'category_id' => Category::where('name', 'Science Fiction')->first()->id ?? null,
                'user_id' => $user->id,
            ],
            [
                'title' => 'Snow Crash',
                'author' => 'Neal Stephenson',
                'description' => 'A novel that blends virtual reality, Sumerian mythology, and a dystopian future.',
                'publication_year' => 1992,
                'category_id' => Category::where('name', 'Science Fiction')->first()->id ?? null,
                'user_id' => $secondUser->id,
            ],
        ];

        $biographyBooks = [
            [
                'title' => 'Long Walk to Freedom',
                'author' => 'Nelson Mandela',
                'description' => 'The autobiography of Nelson Mandela, chronicling his life and struggle against apartheid.',
                'publication_year' => 1994,
                'category_id' => Category::where('name', 'Biography')->first()->id ?? null,
                'user_id' => $secondUser->id,
            ],
            [
                'title' => 'Steve Jobs',
                'author' => 'Walter Isaacson',
                'description' => 'A biography of the Apple co-founder based on extensive interviews.',
                'publication_year' => 2011,
                'category_id' => Category::where('name', 'Biography')->first()->id ?? null,
                'user_id' => $secondUser->id,
            ],
        ];

        $historyBooks = [
            [
                'title' => 'Guns, Germs, and Steel',
                'author' => 'Jared Diamond',
                'description' => 'A look into the factors that shaped the course of human history and civilization.',
                'publication_year' => 1997,
                'category_id' => Category::where('name', 'History')->first()->id ?? null,
                'user_id' => $secondUser->id,
            ],
            [
                'title' => 'The History of the Ancient World',
                'author' => 'Susan Wise Bauer',
                'description' => 'A comprehensive history of the ancient civilizations from Mesopotamia to the fall of Rome.',
                'publication_year' => 2007,
                'category_id' => Category::where('name', 'History')->first()->id ?? null,
                'user_id' => $secondUser->id,
            ],
            [
                'title' => 'A People’s History of the United States',
                'author' => 'Howard Zinn',
                'description' => 'An alternate perspective on American history, focusing on the experiences of marginalized groups.',
                'publication_year' => 1980,
                'category_id' => Category::where('name', 'History')->first()->id ?? null,
                'user_id' => $secondUser->id,
            ],
        ];



        $books = array_merge(
            $malazanBooks,
            $firstLawBooks,
            $fictionBooks,
            $nonFictionBooks,
            $scienceFictionBooks,
            $biographyBooks,
            $historyBooks
        );


        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
