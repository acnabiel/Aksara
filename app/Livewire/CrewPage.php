<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('AKSARA - Crew of Aksara')]
class CrewPage extends Component
{
    public ?string $selectedCrew = null;

    public function openCard(string $image): void
    {
        $this->selectedCrew = $image;
    }

    public function closeCard(): void
    {
        $this->selectedCrew = null;
    }

    public function render()
    {
        // Define crew members organized by position/jabatan
        $crewByPosition = [
            'Ketua Angkatan' => [
                ['name' => 'M. Bardan Billy', 'image' => 'Copy of M. Bardan Rizkifli Bil ilmiah.png'],
            ],
            'Wakil Ketua Angkatan' => [
                ['name' => 'Ilham Nabil Hadhani', 'image' => 'Copy of id card aksara-nabil.png'],
            ],
            'Sekretaris' => [
                ['name' => 'Alliyah', 'image' => 'Copy of id card aksara-Alliyah.png'],
                ['name' => 'Rayhan Nur Ardiansyah', 'image' => 'Copy of Rayhan Nur Ardiansyah.png'],
            ],
            'Bendahara' => [
                ['name' => 'Azka Trie Yafist Mabrur', 'image' => 'Copy of id card aksara-azka trie.png'],
                ['name' => 'Qoluna', 'image' => 'Copy of id card aksara-Qoluna.png'],
            ],
            'Ketua BT / Wakil BT' => [
                ['name' => 'Rayhan Nur Ardiansyah', 'image' => 'Rayhan Nur Ardiansyah.png'],
                ['name' => 'M. Galih Amirrullah', 'image' => 'Copy of M.GALIH AMIRRULLAH (1).png'],
            ],
            'FG, Editor' => [
                ['name' => 'Bayu Agung', 'image' => 'Copy of BAYU.png'],
                ['name' => 'Ridha Dyllem Aulia', 'image' => 'Copy of id card aksaara 2-1@1x_1.png'],
                ['name' => 'Mauludin', 'image' => 'Copy of id card aksara-Mauludin.png'],
                ['name' => 'Reiqy', 'image' => 'Copy of id card aksara-Reiqy.png'],
            ],
            'Crew CAS' => [
                ['name' => 'Aline Ferdika Rehan', 'image' => 'Copy of id card aksara-Ferdika.png'],
                ['name' => 'Noval', 'image' => 'Copy of id card aksara-Noval.png'],
                ['name' => 'Andira', 'image' => 'Copy of id card aksara-Andira.png'],
                ['name' => 'Windy', 'image' => 'Copy of id card aksara-Windy.png'],
            ],
            'Artikel' => [
                ['name' => 'M. Fadil Nasrullah', 'image' => 'Cetak baru/Copy of id card aksara-Fadil.png'],
                ['name' => 'Layla Nisfu', 'image' => 'Copy of id card aksara-Layla nisfu.png'],
                ['name' => 'Liha', 'image' => 'Copy of id card aksara-Liha.png'],
            ],
            'Crew Angkatan' => [
                ['name' => 'Alin Fuziah Musahida', 'image' => 'Alin Fuziah musahida.png'],
                ['name' => 'Bilqis Milani Daus', 'image' => 'Copy of BILQIS MILANI DAUS.png'],
                ['name' => 'Delta Sevilla Rahman', 'image' => 'Copy of Delta sevilla rahman.png'],
                ['name' => 'Dewi Rifki Febriani', 'image' => 'Copy of Dewi Rifki Febriani IMG 9046.jpg'],
                ['name' => 'Galih Ismail', 'image' => 'Copy of Galih Ismail IMG 9026.jpg'],
                ['name' => 'Hafiyyan Akbar', 'image' => 'Copy of HafIyyan Akbar.png'],
                ['name' => 'Meidiana Arbaati', 'image' => 'Copy of Meidiana Arbaati N_.jpg'],
                ['name' => 'Raisya Khoirina', 'image' => 'Copy of RAISYA KHOIRINA ERYANDRA D.png'],
                ['name' => 'Zulvia Imroatu Fauziah', 'image' => 'Copy of Zulvia Imroatu Fauziah.png'],
                ['name' => 'Nindy Nonilay Diarby', 'image' => 'Nindy Nonilay Diarby.png'],
                ['name' => 'Yusnalita Nur Syafika', 'image' => 'Yusnalita Nur Syafika.png'],
                ['name' => 'Nizam', 'image' => 'id card aksara-Nizam.png'],
                ['name' => 'Aldi', 'image' => 'Copy of id card aksara-aldi cicak.png'],
                ['name' => 'Alpi', 'image' => 'Copy of id card aksara-alpi.png'],
                ['name' => 'Asya', 'image' => 'Copy of id card aksara-asya comel.png'],
                ['name' => 'Ayas', 'image' => 'Copy of id card aksara-ayassss.png'],
                ['name' => 'Beniw', 'image' => 'Copy of id card aksara-beniw.png'],
                ['name' => 'Fauzan', 'image' => 'Copy of id card aksara-fauzan.png'],
                ['name' => 'Ihzul', 'image' => 'Copy of id card aksara-ihzul.png'],
                ['name' => 'Jawiz', 'image' => 'Copy of id card aksara-jawiz.png'],
                ['name' => 'Mecha', 'image' => 'Copy of id card aksara-mecha.png'],
                ['name' => 'Merjo', 'image' => 'Copy of id card aksara-merjo.png'],
                ['name' => 'Pais', 'image' => 'Copy of id card aksara-pais.png'],
                ['name' => 'Princess', 'image' => 'Copy of id card aksara-princess.png'],
                ['name' => 'Qiqil', 'image' => 'Copy of id card aksara-qiqil.png'],
                ['name' => 'Ramadhani', 'image' => 'Copy of id card aksara-ramadhani.png'],
                ['name' => 'Rangga', 'image' => 'Copy of id card aksara-rangga.png'],
                ['name' => 'Roikhan', 'image' => 'Copy of id card aksara-roikhan.png'],
                ['name' => 'Tyan', 'image' => 'Copy of id card aksara-tyan.png'],
                // Cetak baru folder
                ['name' => 'Ade Glady Buana', 'image' => 'Cetak baru/Copy of ADE GLADY BUANA.png'],
                ['name' => 'Alfan Rizki Mubarok', 'image' => 'Cetak baru/Copy of ALFAN RIZKI MUBAROK.png'],
                ['name' => 'Febrian Aditya Argani', 'image' => 'Cetak baru/Copy of Febrian Aditya Argani.png'],
                ['name' => 'M. Yusuf Al Ubaidah', 'image' => 'Cetak baru/Copy of M. Yusuf Al Ubaidah.jpg'],
                ['name' => 'Sulthan Dzaki Abyan', 'image' => 'Cetak baru/Copy of Sulthan Dzaki Abyan.jpg'],
                ['name' => 'Gian', 'image' => 'Cetak baru/Copy of id card aksara-Gian.png'],
                ['name' => 'Lucky', 'image' => 'Cetak baru/Copy of id card aksara-Lucky.png'],
                ['name' => 'Nizam', 'image' => 'Cetak baru/Copy of id card aksara-Nizam.png'],
                ['name' => 'Nopan', 'image' => 'Cetak baru/Copy of id card aksara-nopan.png'],
                ['name' => 'Pentha', 'image' => 'Cetak baru/Copy of id card aksara-Pentha.png'],
                ['name' => 'Yazid', 'image' => 'Cetak baru/Copy of id card aksara-Yazid.png'],
                ['name' => 'El Ayala', 'image' => 'Cetak baru/Copy of id card aksara-el ayala.png'],
                ['name' => 'Galang', 'image' => 'Cetak baru/Copy of id card aksara-galang.png'],
                ['name' => 'Ichol', 'image' => 'Cetak baru/Copy of id card aksara-ichol.png'],
                ['name' => 'Ramram', 'image' => 'Cetak baru/Copy of id card aksara-ramram.png'],
                ['name' => 'Valend', 'image' => 'Cetak baru/Copy of id card aksara-valend.png'],
                ['name' => 'Yury', 'image' => 'Cetak baru/Copy of id card aksara-yury.png'],
                ['name' => 'Yusuf', 'image' => 'Cetak baru/Copy of id card aksara-yusuf.png'],
                ['name' => 'Reno', 'image' => 'Cetak baru/id card aksara-renooo.png'],
                ['name' => 'Tegar', 'image' => 'Cetak baru/id card aksara-tegar.png'],
            ],
        ];

        return view('livewire.crew-page', [
            'crewByPosition' => $crewByPosition,
            'totalCrew' => collect($crewByPosition)->flatten(1)->count(),
        ]);
    }
}
