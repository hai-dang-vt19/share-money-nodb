<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chia tiền</title>
    <link rel="stylesheet" href="{{ asset('asset/styles.css') }}">
</head>
<body>
    @php
        if (!empty($count)) {
            $average = $data['total']/$count;
            $max = max($data['inp_price']);
            $first_name = array();
            $sum_an = 0;
            $sum_chi_thieu = 0;
            $sum_lan2 =  0;
            $count_max = 0;

            for ($d = 0; $d < $count; $d++) { 
                if (!empty($data['inp_price'][$d])) {
                    if ($data['inp_price'][$d] == $max) {
                        $first_name = $data['inp_name'][$d];
                        break;
                    }
                }
            }

            for ($e = 0; $e < $count; $e++) { 
                if (empty($data['inp_price'][$e])) {
                    $sum_an+=$average;
                }else{
                    $ck = $data['inp_price'][$e]-$average;
                    if ($ck < 0 and $data['inp_name'][$e] != $first_name) {
                        $sum_chi_thieu += trim($ck,"-");
                    }elseif($ck > 0 and $data['inp_name'][$e] != $first_name){
                        $sum_lan2 += $ck;
                    }
                    $count_max += 1;
                }
            }

            $sum_lan1 = $sum_an+$sum_chi_thieu;
        }
    @endphp

    <form action="{{ route('index') }}" method="GET">
        <div class="container">
            <div class="card" id="card">
                <div id="lst_member">
                    <div class="mb-1">
                        <button type="button" class="btn btn-primary" onclick="input_member()">+ Đầu ăn</button>
                        <button type="button" class="btn btn-primary" onclick="input_chi()">+ Đầu chi</button>
                        <button type="button" class="btn btn-outline-danger" onclick="remove_dauan()" title="Đúp 2 lần xóa từ ô cuối cùng">-&ensp;Đầu ăn</button>
                        <button id="a_Reset" type="button"  class="btn-sm btn-reset"><a href="{{ route('index') }}">Reset</a></button>
                    </div>
                    <input type="hidden" id="inp_qlty_num" name="inp_qlty_num" value="@if (!empty($count)){{$count}}@endif">
                    <input type="hidden" id="total" name="total" value="@if (!empty($count)){{$data['total']}}@endif">
                    <div id="member_chi">
                        @if (!empty($count))
                            @for ($i = 0; $i < $count; $i++)
                                @if (!empty($data['inp_price'][$i]))
                                    <input type="text" name="inp_name[]" id="inp" placeholder="Nhập tên" class="form-control-inpm mb-3" value="{{ $data['inp_name'][$i] }}">
                                    <input type="number" name="inp_price[]" id="price" placeholder="Nhập tên" class="form-control-inpm mb-3" onblur="findTotal()" value="{{ $data['inp_price'][$i] }}">
                                    <br>
                                @endif
                            @endfor
                        @endif
                    </div>
                    <div id="member">
                        @if (!empty($count))
                            @for ($i = 0; $i < $count; $i++)
                                @empty($data['inp_price'][$i])
                                    <input type="text" name="inp_name[]" id="inp" placeholder="Nhập tên" class="form-control-inpm mb-3" value="{{ $data['inp_name'][$i] }}">
                                    <br>
                                @endempty
                            @endfor
                        @endif
                    </div>
                </div>
                <div class="div__submit">
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>   
                @if (!empty($count))
                    <div class="div__table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mỗi người <span class="text-primary">{{ number_format($average) }}</span></th>
                                    <th>Tiền chi</th>
                                    <th>Người gửi</th>
                                    @if ($count_max > 1)
                                        <th>Người nhận</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < $count; $i++)
                                    <tr class='
                                        @if ($i % 2 == 0)
                                            {{ 'bg-light' }}
                                        @endif'
                                    >
                                        <td>{{ $i+1 }}</td>
                                        <td>{{ $data['inp_name'][$i] }}</td>
                                        <td>
                                            @if (!empty($data['inp_price'][$i]))
                                                {{ number_format($data['inp_price'][$i]) }}
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                if (empty($data['inp_price'][$i])) {
                                                    echo 'Bạn gửi <span class="text-danger text-bold text-shadow">'.number_format($average).'</span> cho <span class="text-primary">'.$first_name.'</span>';
                                                }else {
                                                    $dk = $data['inp_price'][$i]-$average;
                                                    if ($dk < 0) {
                                                        echo 'Bạn gửi <span class="text-danger text-bold text-shadow">'.number_format(trim($dk,"-")).'</span> cho <span class="text-primary">'.$first_name.'</span> <br>';
                                                    }elseif($dk == 0 and $data['inp_name'][$i] != $first_name){
                                                        echo 'Còn cái nịt';
                                                    }
                                                }
                                            @endphp
                                        </td>
                                        @if ($count_max > 1)
                                            <td>
                                                @php
                                                    if (!empty($data['inp_price'][$i])) {
                                                            $dk = $data['inp_price'][$i]-$average;
                                                            if ($dk > 0 and $data['inp_name'][$i] != $first_name) {
                                                                $last = $data['inp_price'][$i]-$average;
                                                                echo 'Bạn nhận  <span class="text-success text-bold text-shadow">'.number_format($last).'</span> từ  <span class="text-primary">'.$first_name.'</span> <br>';
                                                            }elseif ($dk == 0 and $data['inp_name'][$i] != $first_name) {
                                                                echo 'Còn cái nịt';
                                                            }
                                                    }
                                                @endphp
                                            </td>
                                        @endif
                                    </tr>
                                @endfor
                                <tr class="tr__total">
                                    <td colspan="3">Tổng: <span class="text-bold">{{ number_format($data['total']) }}</span></td>
                                    <td class="text-center text-danger text-bold">{{number_format($sum_lan1)}}</td>
                                    @if ($count_max > 1)
                                        <td class="text-center text-success text-bold">{{number_format($sum_lan2)}}</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </form>
    <script>
        function findTotal() {
            var arr = document.querySelectorAll("input[type=number]");
            var tot = 0;
            for (var i = 0; i < arr.length; i++) {
                if (parseInt(arr[i].value))
                tot += parseInt(arr[i].value);
            }
            document.getElementById('total').value = tot;

            const VND = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
            });
            document.getElementById('span_total').innerHTML = VND.format(tot);
        }
    </script>
    <script>
        function remove_dauan() {
            let lst_mem = document.getElementById("member");
            lst_mem.removeChild(lst_mem.lastElementChild);

            let count = document.querySelectorAll("input[type=text]").length;    
            document.getElementById('inp_qlty_num').value = count;
        }
    </script>
    <script src="{{ asset('asset/main.js') }}"></script>
</body>
</html>