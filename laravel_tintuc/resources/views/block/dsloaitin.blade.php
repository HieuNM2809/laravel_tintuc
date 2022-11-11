<div class="col-md-3 ">
    <ul class="list-group" id="menu">
        <li href="" class="list-group-item menu1 active">
            Menu
        </li>

        @foreach ($theloai as $tl)
            @if(count($tl->loaitin) > 0)
                <li href="" class="list-group-item menu1">
                {{$tl->Ten}}
                </li>
                <ul class="lstCat">
                    @foreach ($tl->loaitin as  $lt)
                       {{-- bằng 0 là Chưa xóa --}}
                        @if($lt->Xoa == 0)
                            <li class="list-group-item">
                                <a href="loaitin/{{$lt->id}}/{{$lt->TenKhongDau}}.html">{{$lt->Ten}}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
             @endif
        @endforeach
    </ul>
</div>
