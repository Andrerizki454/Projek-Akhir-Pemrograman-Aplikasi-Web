<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class SeedKategori extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:kategori';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed dummy Kategori';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Resetting, BE CAREFUL
        Category::truncate();

        //Isi Disini
        $kategori = [
            "Novel",
            "Cerita Bergambar",
            "Komik",
            "Ensiklopedi",
            "Nomik",
            "Antologi",
            "Dongeng",
            "Biografi",
            "Catatan Harian",
            "Novelet",
            "Fotografi",
            "Karya Ilmiah",
            "Tafsir",
            "Kamus",
            "Panduan",
            "Atlas",
            "Buku Ilmiah",
            "Teks",
            "Majalah",
            "Buku Digital"
        ];

        foreach($kategori as $kat)
        {
            Category::create(["nama_kategori" => $kat]);
        }
        return 0;
    }
}
