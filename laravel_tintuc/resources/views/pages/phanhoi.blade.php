@extends('masterHome')
@section('Noidung')
    <div >
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- Thông báo kết quả --}}
        @if (session('thongbao'))
            <div class="alert alert-success">
                {{ session('thongbao') }}
            </div>
        @endif
        <form action="phanhoi" method="post" style="width: 80vw;margin: auto;" >
            @csrf
            @method('post')
            <h1>Gửi phản hồi</h1>
            <textarea name="txtPhanHoi" id="editor1" rows="10" cols="80">
            </textarea>
            <button name="btnPhanHoi" type="submit" >Gửi</button>
        </form>
    </div>
@endsection
@section('script')
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace( 'editor1' );
    </script>
@endsection