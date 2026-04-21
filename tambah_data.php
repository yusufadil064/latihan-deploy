<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
    <style>
        /* Reset & Base Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        /* Card Container */
        .card {
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }

        .card h2 {
            text-align: center;
            color: #333333;
            margin-top: 0;
            margin-bottom: 25px;
        }

        /* Form Group Layout */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            color: #555555;
            font-size: 14px;
            font-weight: 600;
        }

        /* Input & Select Styles */
        .form-group input[type="text"],
        .form-group select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 14px;
            color: #333333;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        /* Focus States */
        .form-group input[type="text"]:focus,
        .form-group select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }

        /* Disabled State untuk Dropdown Kab/Kota */
        .form-group select:disabled {
            background-color: #e9ecef;
            cursor: not-allowed;
            color: #888888;
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #28a745; /* Warna hijau senada dengan dashboard admin Anda */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="card">
        <h2>Tambah Mahasiswa</h2>
        <form action="proses/prosesTambah.php" method="POST">
            
            <div class="form-group">
                <label for="nim">Nomor Induk Mahasiswa (NIM)</label>
                <input type="text" id="nim" name="nim" placeholder="Masukkan NIM" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" required>
            </div>

            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input type="text" id="jurusan" name="jurusan" placeholder="Masukkan Jurusan" required>
            </div>

            <div class="form-group">
                <label for="provinsi">Provinsi (API BPS)</label>
                <select name="provinsi" id="provinsi" required>
                    <option value="">-- Loading Data Provinsi... --</option>
                </select>
            </div>

            <div class="form-group">
                <label for="kabupaten">Kabupaten / Kota</label>
                <select name="kabupaten" id="kabupaten" required disabled>
                    <option value="">-- Pilih Provinsi Terlebih Dahulu --</option>
                </select>
            </div>

            <input type="hidden" name="nama_provinsi" id="nama_provinsi">

            <button type="submit" class="btn-submit">Simpan Data</button>
        </form>
    </div>

    <script>
        const selectProvinsi = document.getElementById('provinsi');
        const selectKabupaten = document.getElementById('kabupaten');
        const inputNamaProvinsi = document.getElementById('nama_provinsi');

        // 1. Ambil data Provinsi (Panggil get_alamat.php dengan type=provinsi)
        fetch('API/get_alamat.php?type=provinsi')
            .then(response => response.json())
            .then(data => {
                selectProvinsi.innerHTML = '<option value="">-- Pilih Provinsi --</option>';
                data.data[1].forEach(prov => {
                    let option = document.createElement('option');
                    option.value = prov.domain_id; // Simpan Kode Provinsi
                    option.text = prov.domain_name;
                    selectProvinsi.appendChild(option);
                });
            })
            .catch(err => console.error("Gagal load Provinsi:", err));

        // 2. Trigger saat Provinsi dipilih
        selectProvinsi.addEventListener('change', function () {
            const provId = this.value;
            inputNamaProvinsi.value = this.options[this.selectedIndex].text;

            selectKabupaten.innerHTML = '<option value="">-- Loading Data... --</option>';
            selectKabupaten.disabled = true;

            if (provId) {
                // Panggil get_alamat.php dengan type=kabupaten DAN prov_id
                fetch(`API/get_alamat.php?type=kabupaten&prov_id=${provId}`)
                    .then(res => res.json())
                    .then(data => {
                        selectKabupaten.innerHTML = '<option value="">-- Pilih Kab/Kota --</option>';
                        selectKabupaten.disabled = false;

                        data.data[1].forEach(kab => {
                            let option = document.createElement('option');
                            option.value = kab.domain_name; // Simpan Nama Kab/Kota
                            option.text = kab.domain_name;
                            selectKabupaten.appendChild(option);
                        });
                    })
                    .catch(err => console.error("Gagal load Kab/Kota:", err));
            } else {
                selectKabupaten.innerHTML = '<option value="">-- Pilih Provinsi Terlebih Dahulu --</option>';
                inputNamaProvinsi.value = '';
            }
        });
    </script>
</body>

</html>