<style>
        ul li{
            display: inline-block;
        }
        ul li a{
            padding: 10px;
        }
        header h1{
            float: left;
        }
        header p{
            float: right;
            padding-top: 20px;
        }

        ul{
            position: relative;
        }

        ul li ul{
            position: absolute;
            display: none;
            padding:0;
        }

        ul ul li {
            display: block;
        }

        ul ul li a{
            display: block;
            padding: 5px;
        }

        ul li:hover ul{
            display: block;
        }
    </style>
<header>
        <h1><?= $title ?></h1>
        <p>Hello, <?= $_SESSION['nama_petugas'] ?> | <a href="/ukk-inventory/logout.php">Keluar</a></p>
    </header>
    <div style="clear: both"></div>
    <hr>
        <ul>
            <li><a href="/ukk-inventory/index.php">Dashboard</a></li>
            <?php
                if($_SESSION['level'] == "Administrator"){
                    ?>
                        <li><a href="#">Master Data</a>
                            
                        <ul>
                                <li><a href="/ukk-inventory/inventaris">Inventaris</a></li>
                                <li><a href="/ukk-inventory/jenis">Jenis</a></li>
                                <li><a href="/ukk-inventory/jenis">Ruang</a></li>
                                <li><a href="/ukk-inventory/level">Level</a></li>
                                <li><a href="/ukk-inventory/petugas">Petugas</a></li>
                                <li><a href="/ukk-inventory/peminjam">Peminjam</a></li>
                                <li><a href="/ukk-inventory/laporan">Laporan</a></li>
                            </ul>
                        </li>
                    <?php
                }
            ?>
            
            <li><a href="/ukk-inventory/peminjaman">Peminjaman</a></li>
        </ul>
<hr>