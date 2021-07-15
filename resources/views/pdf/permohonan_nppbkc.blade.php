<html>
   <head>
      <style>
         @page { margin: 30px; }
          body{
              margin-left:60px;
              margin-right:20px;
          }

         hr {
            margin-top: -10px;
            height:3px;
            border-top:5px solid black;
            border-bottom:1px solid black;
         }
         table, tr, td {
            border: none;
         }
         p{
            text-align: justify;
            margin-top: 0px;
         }
         td{
            vertical-align: top;
         }
         tr{
            line-height: 14px; 
         }
         ol li li{
            vertical-align: middle;
            line-height: 16px; 
         }
         ol li{
            vertical-align: middle;
            line-height: 18px; 
         }
         .span-li {
            display: inline-block;
            vertical-align: middle;
            width: 130px;
            margin-top: 2px;
            margin-bottom: 2px;
         }

         .span-li-w-150 {
            display: inline-block;
            vertical-align: middle;
            width: 150px;
            margin-top: 2px;
            margin-bottom: 2px;
         }
         .mt-15{
            margin-top: 15px;
         }
         .mt-5{
            margin-top: 5px;
         }

      </style>
   </head>
   <body>
      <p style="text-align: center;margin-top:10px">
         <span style="font-size:14pt"><strong>[NAMA_USAHA]</strong></span><br/>
         <strong>[ALAMAT_USAHA]</strong>
      </p>
      <hr />
      <table style="width: 90%; border-style: none;">
         <tbody>
            <tr>
               <td style="width: 50px;">Nomor</td>
               <td style="width: 10px">&nbsp;:</td>
               <td>[NO_PERMOHONAN]</td>
            </tr>
            <tr>
               <td>Lampiran</td>
               <td>&nbsp;:</td>
               <td>1 (Satu) Berkas</td>
            </tr>
            <tr>
               <td>Hal</td>
               <td>&nbsp;:</td>
               <td><p>Permohonan Mendapatkan Nomor Pokok Pengusaha Barang Kena Cukai (NPPBKC) sebagai [JENIS_USAHA_BKC] [JENIS_BKC]</p></td>
            </tr>
         </tbody>
      </table>
      <p style="padding-bottom: 5px;padding-top:10px">
         Yth. Menteri Keuangan Republik Indonesia<br/>
         u.p. Kepala Kantor Bea dan Cukai Tipe Madya Pabean C Palangkaraya<br/>
         di Palangka Raya
      </p>
      Dengan hormat,<br/><br/>
      <span>Yang bertanda tangan dibawah ini:</span>
      <table  style="width: 100%;">
         <tbody>
            <tr style="">
               <td style="width: 160px; ">nama</td>
               <td style="width: 10px; ">:</td>
               <td>[NAMA_USER]</td>
            </tr>
            <tr style="">
               <td style="width: 12.2055%; ">pekerjaan/jabatan</td>
               <td style="width: 1.16487%; ">:</td>
               <td style="width: 86.6295%; ">[PEKERJAAN_USER]</td>
            </tr>
            <tr style="">
               <td style="width: 12.2055%; ">alamat</td>
               <td style="width: 1.16487%; ">:</td>
               <td style="width: 86.6295%; ">[ALAMAT_USER]</td>
            </tr>
            <tr style="">
               <td style="width: 12.2055%; ">nomor telepon</td>
               <td style="width: 1.16487%; ">:</td>
               <td style="width: 86.6295%; ">[TELP_USER]</td>
            </tr>
            <tr style="">
               <td style="width: 20%; ">alamat ponsel (<em>e-mail</em>)</td>
               <td style="width: 1.16487%; ">:</td>
               <td style="width: 86.6295%; "><em>[EMAIL_USER]</em></td>
            </tr>
         </tbody>
      </table>
      <br/>
      <span>Bertindak atas nama:</span>
      <table style="width: 100%; ">
        <tbody>
            <tr style="">
               <td style="width: 160px; ">nama</td>
               <td style="width: 10px; ">:</td>
               <td>[NAMA_PEMILIK]</td>
            </tr>
            <tr style="">
            <td style="width: 14.1118%; ">alamat</td>
            <td style="width: 0.794281%; ">:</td>
            <td style="width: 86.6295%; ">[ALAMAT_PEMILIK]</td>
            </tr>
                <tr style="">
                <td style="width: 14.1118%; ">nomor telepon</td>
                <td style="width: 0.794281%; ">:</td>
                <td style="width: 86.6295%; ">[TELP_PEMILIK]</td>
            </tr>
            <tr style="">
                <td style="width: 20%; ">alamat ponsel (<em>e-mail</em>)</td>
                <td style="width: 0.794281%; ">:</td>
                <td style="width: 86.6295%; "><em>[EMAIL_PEMILIK]</em></td>
            </tr>
        </tbody>
      </table>
      <br/>
      <p>Mengajukan permohonan untuk mendapatkan NPPBKC sebagai Pengusaha [JENIS_USAHA_BKC]  Barang Kena Cukai Berupa [JENIS_BKC] dengan rincian sebagai berikut:</p>
      <ol>
         <li class="mt-5">
            <span>Perusahaan : </span>
            <ol style="list-style-type: lower-alpha;">
               <li><span class="span-li-w-150">nama</span> : [NAMA_USAHA]</li>
               <li><span class="span-li-w-150">alamat</span> : [ALAMAT_USAHA]</li>
               <li><span class="span-li-w-150">NPWP</span> : [NPWP_USAHA]</li>
               <li><span class="span-li-w-150">nomor telepon</span> : [TELP_USAHA]</li>
               <li><span class="span-li-w-150">alamat ponsel (<em>e-mail</em>)</span> : <em>[EMAIL_USAHA]</em></li>
            </ol>
         </li>
         
         <li class="mt-15"><span>Lokasi [JENIS_USAHA_BKC] :</span>
            <ol style="list-style-type: lower-alpha;">
                <li>
                   <span>Lokasi 1:</span>
                   <ol>
                      <li><span class="span-li">kegunaan</span> : [KEGUNAAN]</li>
                      <li><span class="span-li">alamat</span> : [ALAMAT]</li>
                      <li><span class="span-li">kelurahan/desa</span> : [VILLAGE]</li>
                      <li><span class="span-li">kecamatan</span> : [DISTRICT]</li>
                      <li><span class="span-li">kabupaten/kota</span> : [REGENCY]</li>
                      <li><span class="span-li">provinsi</span> : [PROVINCE]</li>
                      <li><span class="span-li">koordinat/geolokasi</span> : [MAP_URL]</li>
                   </ol>
                </li>
                <li class="mt-15">
                   <span>Lokasi 2:</span>
                   <ol>
                      <li><span class="span-li">kegunaan</span> : </li>
                      <li><span class="span-li">alamat</span> : </li>
                      <li><span class="span-li">kelurahan/desa</span> : </li>
                      <li><span class="span-li">kecamatan</span> : </li>
                      <li><span class="span-li">kabupaten/kota</span> : </li>
                      <li><span class="span-li">provinsi</span> : </li>
                      <li><span class="span-li">koordinat/geolokasi</span> : </li>
                   </ol>
                </li>
            </ol>
         </li>
         
         <li class="mt-15">
            <span>Izin Usaha dari instansi terkait:</span>
            <ol style="list-style-type: lower-alpha;">
               <li><span class="span-li">SIUP-MB SKMB</span> : Nomor [NO_SIUP_MB] tanggal [MASA_BERLAKU_SIUP_MB_FROM]</li>
               <li><span class="span-li">ITP-MB</span> : Nomor [NO_ITP_MB] tanggal [MASA_BERLAKU_ITP_MB_FROM]</li>
               <li><span class="span-li">NIB</span> : Nomor [NO_IZIN_NIB] tanggal [TANGGAL_NIB]</li>
            </ol>
         </li>
         
         <li class="mt-15">
            <p>Luas lokasi, luas bangunan, dan batas-batas lokasi yang akan dijadikan tempat usaha sebagaimana tertera dalam berita acara pemeriksaan lokasi nomor [NO_BA_CEK_LOKASI] tanggal [TANGGAL_BA_CEK_LOKASI].</p>
         </li>
         
         <li class="mt-15"><span>Lampiran-lampiran :</span>
            <ol style="list-style-type: lower-alpha;">
               <li>berita acara pemeriksaan lokasi;</li>
               <li>salinan/fotocopy izin usaha dari instansi terkait;</li>
               <li>lampiran lainnya.</li>
            </ol>
         </li>
      </ol>
      <br/>
      <p style="margin-left: 330px">
         Dibuat di [REGENCY]<br/>
         Pada tanggal [TANGGAL_PERMOHONAN_NPPBKC]<br/>
         <br/>
         Pemohon,<br/>
         <br/>
         [QRCODE]<br/>
         <br/>
         <span style="font-size:12pt"><strong>[NAMA_USER]</strong></span>
      </p>
   </body>
</html>