@extends('layouts-admin.head')

@section('content')
    <style>
        .kbw-signature {
            width: 20vw;
            height: 200px;
        }

        #sig canvas {
            width: 100%;
            height: auto;
        }

        @media only screen and (max-width: 770px) {
            .kbw-signature {
                width: 400px;
                height: 200px;
            }

            #sig canvas {
                width: 100%;
                height: auto;
            }
        }
    </style>

    <div class="container-fluid">
        <div class="">
            <form method="POST" action="{{ asset('/transaksi-tangan/tambah') }}">
                @csrf
                <input type="text" value="{{ $id }}" hidden name="id">

                <div class="mb-3">
                    <label for="signature" class="form-label">Tanda Tangan</label>
                    <div class="sign-container">

                        <div id="sig"></div>
                        <textarea id="signature64" name="signed" style="display: none"></textarea>
                    </div>
                    <button id="clear" class="btn btn-danger btn-sm">Reset</button>
                    <button class="btn btn-success btn-sm">Save</button>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        var sig = $('#sig').signature({
            syncField: '#signature64',
            syncFormat: 'PNG'
        });
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
    </script>
@endsection
