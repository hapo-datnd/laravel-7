@extends('layouts.app')

@section('content')
    <div style="width: 300px; margin: auto">
        <form method="" action="">
            @csrf
            <div>
                <label for="member">
                    Member
                </label>
                <select name="" id="member">
                    @foreach($members as $member)
                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="project">
                    Project
                </label>
                <select name="project" id="project">
                    <option value="da">da</option>
                    <option value="n">n</option>
                    <option value="1">1</option>
                </select>
            </div>
        </form>
    </div>
    <input type="hidden" id="getMemberUrl" value="{{ route('get_member') }}">
@endsection
@section('scripts')
    <script
        src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });
            $(document).on('change', '#project', function() {
                let url = $('#getMemberUrl').val();
                $.ajax({
                    type: 'POST',
                    url,
                    data: {
                        search: $(this).val(),
                    },
                    success(data) {
                        let html = '';
                        $.each(data, function (key, value) {
                            html += `<option value="${value.id}">${value.name}</option>`;
                        });
                        $('#member').html(html);
                    },
                    error() {

                    },
                });
            });
        });
    </script>
@endsection
