<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Cetak Barcode</title>

        <style>
            .text-center {
                text-align: center;
            }
        </style>
    </head>

    <body>
        <table width="100%">
            <tr>
                @foreach ($dataPrintBarcode as $produk)
                <td class="text-center">
                    <p>
                        {{ $produk->nama_produk }}
                        -Rp.{{ format_uang($produk->harga_jual) }}
                    </p>
                    <img
                        src="data:image/svg,{{ DNS1D::getBarcodeSVG($produk->kode_produk, 'C39', 3, 1, 'black', false) }}"
                        alt="barcode/"
                        width="180"
                        height="30"
                        style="height: 50px"
                    />
                    <br />
                    {{ $produk->kode_produk }}
                </td>
                @if ($no++ % 2 == 0)
            </tr>
            <tr>
                @endif @endforeach
            </tr>
        </table>
    </body>
</html>
