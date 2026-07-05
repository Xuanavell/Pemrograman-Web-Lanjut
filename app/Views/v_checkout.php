<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-6">
        <?= form_open('buy', 'class="row g-3"') ?>

        <?= form_hidden('username', session()->get('username')) ?>
        <?= form_input([
            'type' => 'hidden',
            'name' => 'total_harga',
            'id'   => 'total_harga',
            'value' => '']) ?>
        <div class="col-12">
            <?= form_label('Nama', 'nama', ['class' => 'form-label']) ?>
            <?= form_input([
                'name'     => 'nama',
                'id'       => 'nama',
                'class'    => 'form-control',
                'value'    => session()->get('username'),
                'readonly' => true]) ?>
        </div>
        <div class="col-12">
            <?= form_label('Alamat', 'alamat', ['class' => 'form-label']) ?>
            <?= form_input([
                'name'  => 'alamat',
                'id'    => 'alamat',
                'class' => 'form-control']) ?>
        </div> 
        <div class="col-12"> 
            <?= form_label('Kelurahan', 'kelurahan', ['class' => 'form-label']) ?>
            <?= form_dropdown('kelurahan', [], '', ['id' => 'kelurahan', 'class' => 'form-control']) ?>        
        </div>

        <div class="col-12"> 
            <?= form_label('Layanan', 'layanan', ['class' => 'form-label']) ?> 
            <?= form_dropdown('layanan', [], '', ['id' => 'layanan', 'class' => 'form-control']) ?>
        </div>

        <div class="col-12">
            <?= form_label('Ongkir', 'ongkir', ['class' => 'form-label']) ?>
            <?= form_input([
                'name'     => 'ongkir',
                'id'       => 'ongkir',
                'class'    => 'form-control',
                'readonly' => true]) ?>
        </div>
        <div class="col-12"> 
            <?= form_label('Kode Voucher', 'kupon_code', ['class' => 'form-label']) ?>
            <?= form_input([
                'name'  => 'kupon_code',
                'id'    => 'kupon_code',
                'class' => 'form-control']) ?>
            <small>Tersedia: PROMO2025 (10%), PROMO2026 (15%), AKHIRTAHUN (25%)</small>
        </div>
        <div class="col-12">
            <?= form_submit(
                'submit',
                'Buat Pesanan',
                ['class' => 'btn btn-primary']) ?>
        </div>

        <?= form_close() ?> 
    </div>
    <div class="col-lg-6">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (!empty($items)) :
                    foreach ($items as $index => $item) :
                ?>
                        <tr>
                            <td><?= $item['name'] ?></td>
                            <td><?= number_to_currency($item['price'], 'IDR') ?></td>
                            <td><?= $item['qty'] ?></td>
                            <td><?= number_to_currency($item['price'] * $item['qty'], 'IDR') ?></td>
                        </tr>
                <?php
                    endforeach;
                endif;
                ?>
                <tr>
                    <td colspan="2"></td>
                    <td>Subtotal</td>
                    <td><?= number_to_currency($total, 'IDR') ?></td>
                </tr>
                <tr> //
                    <td colspan="2"></td>
                    <td class="text-danger">Diskon Voucher <span id="diskon_persen"></span></td>
                    <td class="text-danger"><span id="diskon_kupon">-IDR 0</span></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td>Biaya Jasa</td>
                    <td><span id="biaya_admin">IDR 0</span></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="text-success">Free Mouse</td>
                    <td class="text-success"><span id="free_mouse">-IDR 150,000</span></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="text-primary">Subtotal Promo</td>
                    <td class="text-primary"><span id="subtotal_promo"><?= number_to_currency($total, 'IDR') ?></span></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td><strong>Grand Total<br>(incl. Ongkir)</strong></td>
                    <td><strong><span id="total"><?= number_to_currency($total, 'IDR') ?></span></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
$(document).ready(function() {
    let ongkir = 0;
    let subtotal = <?= $total ?>;
    let freeMouse = 150000;
    hitungTotal();

    function formatRupiah(nilai) {
        return `IDR ${nilai.toLocaleString('en-US')}`;
    }

    function formatMinusRupiah(nilai) {
        return `-IDR ${nilai.toLocaleString('en-US')}`;
    }
    // Fungsi untuk menghitung diskon kupon
    function hitungDiskonKupon(total_harga, kupon_code) {
        if (kupon_code == 'PROMO2025') {
            return total_harga * 0.10;
        } else if (kupon_code == 'PROMO2026') {
            return total_harga * 0.15;
        } else if (kupon_code == 'AKHIRTAHUN') {
            return total_harga * 0.25;
        } else {
            return 0;
        }
    }
    // Fungsi untuk menghitung biaya admin
    function hitungBiayaAdmin(total_harga) {
        return total_harga * 0.02;
    }

    function hitungPersenKupon(kupon_code) {
        if (kupon_code == 'PROMO2025') {
            return '(10%)';
        } else if (kupon_code == 'PROMO2026') {
            return '(15%)';
        } else if (kupon_code == 'AKHIRTAHUN') {
            return '(25%)';
        } else {
            return '';
        }
    }
    // Fungsi untuk menghitung total harga
    function hitungTotal() {
        let kupon_code = $("#kupon_code").val().toUpperCase();
        let diskon_kupon = hitungDiskonKupon(subtotal, kupon_code);
        let biaya_admin = hitungBiayaAdmin(subtotal);
        let subtotal_promo = subtotal - diskon_kupon + biaya_admin - freeMouse;
        let total = subtotal_promo + ongkir;
    // Update nilai input dan teks di halaman
        $("#ongkir").val(ongkir);
        $("#diskon_persen").text(hitungPersenKupon(kupon_code));
        $("#diskon_kupon").text(formatMinusRupiah(diskon_kupon));
        $("#biaya_admin").text(formatRupiah(biaya_admin));
        $("#subtotal_promo").text(formatRupiah(subtotal_promo));
        $("#total").text(formatRupiah(total));
        $("#total_harga").val(total);
    }

    $("#kupon_code").on('keyup change', function() {
        hitungTotal();
    });

	$('#kelurahan').select2({
	    placeholder: 'Cari daerah tujuan',
	    minimumInputLength: 3, 
        ajax: {
            url: '<?= site_url('ajax/destinations') ?>',
            dataType: 'json',
            delay: 300,
            data: function(params) {
                return {
                    q: params.term
                };
            },
            processResults: function(data) {
                return data;
            },
            cache: true
        }
	});
    $("#kelurahan").on('change', function () {
        let id_kelurahan = $(this).val();

        $("#layanan").empty();
        ongkir = 0;
        hitungTotal(); 

        if (id_kelurahan) {
            $.ajax({
                url: "<?= site_url('ajax/costs') ?>",
                dataType: "json",
                data: {
                    destination: id_kelurahan
                },
                success: function(data) {
                    if (data && data.length > 0) {
                        data.forEach(function(item) {
                            $("#layanan").append(
                                $('<option>', {
                                    value: item.cost,
                                    text: `${item.description} (${item.service}) : estimasi ${item.etd}`
                                })
                            );
                        });
                        // Trigger change to update shipping cost with the first option's cost
                        $("#layanan").trigger('change');
                    } else {
                        $("#layanan").append($('<option>', { value: 0, text: 'Layanan tidak tersedia' }));
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Gagal memuat layanan:", error);
                    $("#layanan").append($('<option>', { value: 0, text: 'Gagal memuat layanan' }));
                }
            });
        }
    });

    $("#layanan").on('change', function() {
    ongkir = parseInt($(this).val()) || 0;
    hitungTotal();
    }); 

});
</script>
<?= $this->endSection() ?>
