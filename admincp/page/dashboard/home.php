<?php

    $randomVideo = array(
        array("【原神】キャラクター実戦紹介動画　胡桃(フータオ)「生者、近寄るなかれ」", "https://www.youtube.com/embed/vRj3YbsVTPc?autoplay=1&controls=0&loop=1"),
        array("Renai Circulation「恋愛サーキュレーション」歌ってみた【＊なみりん】", "https://www.youtube.com/embed/uKxyLmbOc0Q?autoplay=1&controls=0&loop=1"),
        array("Rick Astley - Never Gonna Give You Up (Video)", "https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&controls=0&loop=1"),
        array("【原神】キャラクター実戦紹介　クレー(CV：久野美咲)「たったた！」", "https://www.youtube.com/embed/7-VnFQvCLDc?autoplay=1&controls=0&loop=1"),
        array("\"Kaguya-sama: Love is War?\" Opening Theme (Limited Time Only)", "https://www.youtube.com/embed/lTlzDfhPtFA?autoplay=1&controls=0&loop=1"),
        array("Kaguya-sama: Love is War Opening 1 | 4K | 60FPS | Creditless | Flac.", "https://www.youtube.com/embed/_4NjEOtSQww?autoplay=1&controls=0&loop=1"),
        array("Sweet Parade [original][short]", "https://www.youtube.com/embed/CUYjNWOQ_S8?autoplay=1&controls=0&loop=1"),
        array("Material Girl - Inugami Korone Material Doggo (Hololive Engsub)", "https://www.youtube.com/embed/zqchJr3lRlk?autoplay=1&controls=0&loop=1"),
        array("Genshin Phantasm - Genshin Impact ft. Carnival Phantasm OP", "https://www.youtube.com/embed/3dTZo2piix4?autoplay=1&controls=0&loop=1"),
        array("Super☆Affection [すーぱー☆あふぇくしょん] (Carnival Phantasm OP) Full Version (Video: CP + Fate/Zero)", "https://www.youtube.com/embed/4iXenMW9nHA?autoplay=1&controls=0&loop=1"),
    );

    $indRandVid = rand(0, count($randomVideo) - 1);
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Home</h1>
        <p>Advertisement: <?= $randomVideo[$indRandVid][0]?></p>
        <iframe width="1253" height="705"
            src="<?= $randomVideo[$indRandVid][1] ?>">
        </iframe>
    </div>
    <!-- /.container-fluid -->