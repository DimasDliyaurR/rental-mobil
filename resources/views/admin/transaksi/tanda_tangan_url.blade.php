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
    </style>

    <div class="container-fluid">
        <div class="">
            <form method="POST" action="{{ asset('upload-sign') }}">
                @csrf
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
    <div class="container-fluid mt-3">
        <label class="form-label">Link Tanda Tangan</label>
        <div class="mb-3 d-flex">
            <div class="row">
                <input type="text" id="copy_{{ $url }}" value="{{ $url }}" class="form-control">
            </div>
            <div class="row">
                <button value="copy" onclick="copyToClipboard('copy_{{ $url }}')"
                    class="btn btn-info btn-sm">Copy!</button>
            </div>
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

        function copyToClipboard(id) {
            document.getElementById(id).select();
            document.execCommand('copy');
        }
    </script>
@endsection
