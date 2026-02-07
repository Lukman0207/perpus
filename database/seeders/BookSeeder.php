<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'judul' => 'Pemrograman Web dengan Laravel',
                'penulis' => 'John Doe',
                'penerbit' => 'Pustaka Teknologi',
                'tahun' => 2023,
                'stok' => 5,
                'kategori' => 'Teknologi',
                'isbn' => '978-1234567890',
                'deskripsi' => 'Buku lengkap tentang pemrograman web menggunakan framework Laravel.',
            ],
            [
                'judul' => 'Database Management System',
                'penulis' => 'Jane Smith',
                'penerbit' => 'Penerbit Informatika',
                'tahun' => 2022,
                'stok' => 3,
                'kategori' => 'Teknologi',
                'isbn' => '978-0987654321',
                'deskripsi' => 'Panduan lengkap tentang sistem manajemen database.',
            ],
            [
                'judul' => 'Algoritma dan Struktur Data',
                'penulis' => 'Ahmad Fauzi',
                'penerbit' => 'Pustaka Komputer',
                'tahun' => 2024,
                'stok' => 7,
                'kategori' => 'Teknologi',
                'isbn' => '978-1122334455',
                'deskripsi' => 'Materi lengkap tentang algoritma dan struktur data dalam pemrograman.',
            ],
            [
                'judul' => 'Sejarah Indonesia Modern',
                'penulis' => 'Prof. Dr. Sejarawan',
                'penerbit' => 'Penerbit Sejarah',
                'tahun' => 2021,
                'stok' => 4,
                'kategori' => 'Sejarah',
                'isbn' => '978-5566778899',
                'deskripsi' => 'Sejarah perkembangan Indonesia dari masa kemerdekaan hingga sekarang.',
            ],
            [
                'judul' => 'Matematika Dasar',
                'penulis' => 'Dr. Matematika',
                'penerbit' => 'Pustaka Ilmu',
                'tahun' => 2023,
                'stok' => 6,
                'kategori' => 'Sains',
                'isbn' => '978-9988776655',
                'deskripsi' => 'Buku pegangan untuk memahami matematika dasar.',
            ],
            [
                'judul' => 'Fisika Modern',
                'penulis' => 'Prof. Fisika',
                'penerbit' => 'Penerbit Sains',
                'tahun' => 2022,
                'stok' => 5,
                'kategori' => 'Sains',
                'isbn' => '978-4433221100',
                'deskripsi' => 'Pembahasan lengkap tentang konsep-konsep fisika modern.',
            ],
            [
                'judul' => 'Bahasa Inggris untuk Pemula',
                'penulis' => 'English Teacher',
                'penerbit' => 'Pustaka Bahasa',
                'tahun' => 2023,
                'stok' => 8,
                'kategori' => 'Bahasa',
                'isbn' => '978-3322110099',
                'deskripsi' => 'Panduan belajar bahasa Inggris untuk pemula.',
            ],
            [
                'judul' => 'Kewirausahaan',
                'penulis' => 'Entrepreneur',
                'penerbit' => 'Penerbit Bisnis',
                'tahun' => 2024,
                'stok' => 4,
                'kategori' => 'Bisnis',
                'isbn' => '978-2211009988',
                'deskripsi' => 'Materi tentang kewirausahaan dan cara memulai bisnis.',
            ],
            [
                'judul' => 'Biologi Sel',
                'penulis' => 'Dr. Biologi',
                'penerbit' => 'Pustaka Biologi',
                'tahun' => 2022,
                'stok' => 5,
                'kategori' => 'Sains',
                'isbn' => '978-1100998877',
                'deskripsi' => 'Penjelasan lengkap tentang struktur dan fungsi sel.',
            ],
            [
                'judul' => 'Seni Rupa',
                'penulis' => 'Seniman',
                'penerbit' => 'Penerbit Seni',
                'tahun' => 2023,
                'stok' => 3,
                'kategori' => 'Seni',
                'isbn' => '978-0099887766',
                'deskripsi' => 'Pengantar seni rupa dan berbagai teknik menggambar.',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
