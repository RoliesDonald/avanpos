<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Cetak Kartu Member</title>

        <style>
            .box {
                position: relative;
            }

            .card {
                width: 85.6mm;
            }

            .logo {
                position: absolute;
                top: 3pt;
                right: 0pt;
                font-size: 16pt;
                font-family: Arial, Helvetica, sans-serif;
                font-weight: bold;
                color: #fff !important;
            }

            .logo p {
                text-align: right;
                margin-right: 16pt;
            }

            .logo img {
                position: absolute;
                margin-top: -5pt;
                width: 40px;
                height: 40px;
                right: 16pt;
            }

            .nama {
                position: absolute;
                top: 100pt;
                right: 16pt;
                font-size: 12pt;
                font-family: Arial, Helvetica, sans-serif;
                font-weight: bold;
                color: #fff !important;
            }

            .telepon {
                position: absolute;
                margin-top: 120pt;
                right: 16pt;
                color: #fff;
            }

            .barcode {
                position: absolute;
                top: 105pt;
                left: 0.86rem;
                border: 1px solid #fff;
                padding: 0.5px;
                background: #fff;
            }

            .text-left {
                text-align: left;
            }

            .text-right {
                text-align: right;
            }

            .text-center {
                text-align: center;
            }
        </style>
    </head>

    <body>
        <section style="border: 1px solid #fff">
            <table width="100%">
                @foreach ($cetakIdCardMember as $key => $data)
                    <tr>
                        @foreach ($data as $item)
                            <td class="text-center">
                                <div class="box">
                                    <img src="{{ asset('/public/images/member.png') }}" alt="card" width="20%" />
                                    <div class="logo">
                                        <p>Avan</p>
                                        <img src="{{ asset('/public/images/logo.png') }}" alt="logo"
                                            width="50%" />
                                    </div>
                                    <div class="nama">{{ $item->nama }}</div>
                                    <div class="telepon">{{ $item->telepon }}</div>
                                    <div class="barcode text-left">
                                        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG("$item->kode_member", 'C39') }}"
                                            alt="barcode/" width="180" height="30" style="height: 50px" />
                                        {{-- <img src="data:image/png;base64, {{ DNS1D::getBarcodePNG("$item->kode_member", 'C39') }}"
                                            alt="qrcode" height="45" widht="45"> --}}
                                    </div>
                                </div>
                            </td>

                            @if (count($cetakIdCardMember) == 1)
                                <td class="text-center" style="width: 50%"></td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </table>
        </section>
    </body>

</html>
