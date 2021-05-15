<?php

namespace App\Console\Commands;

use App\Models\Pekerjaan;
use Illuminate\Console\Command;


class SeedPekerjaan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:pekerjaan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengisi Field Pekerjaan';

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
        //HATI-HATI, PROCEED WITH CAUTIOUS

        $pekerjaan = [ 
            "Guru",
            "Dosen",
            "Polisi",
            "Tentara",
            "Pilot",
            "Pramugari",
            "Satpam",
            "Nelayan",
            "Penyelam",
            "Nahkoda",
            "Sopir",
            "Kondektur",
            "Masinis",
            "Perawat",
            "Dokter",
            "Bidan",
            "Pengacara",
            "Programmer",
            "Pedagang",
            "Pemandu Wisata",
            "Penambang",
            "Petani",
            "Peternak",
            "Fashion Designer",
            "Tukang",
            "Chef",
            "Pramusaji",
            "Kasir",
            "Wartawan",
            "Seniman",
            "Penari",
            "Penulis",
            "Arsitek",
            "Atlet Profesional",
            "Porter",
            "Apoteker",
            "Hakim",
            "Jaksa",
            "Montir",
            "Mahasiswa",
            "Pelajar",
            "Lainnya"
        ];

        foreach($pekerjaan as $kerjaan)
            Pekerjaan::create(["nama_pekerjaan" => $kerjaan]);

        return 0;
    }
}
