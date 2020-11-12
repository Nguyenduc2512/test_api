<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<html>
    <div class="container">
        <div class="row">
            @foreach($data as $bank)
                @if($bank->type == 1)
                    <div class="col-2">
                        <form action="{{route('send_order')}}" method="POST" enctype="multipart/form-data" class="form_data">
                            @csrf
                            <img src="{{$bank->bank_logo}}" alt="" style="width: 100px">
                            <input type="hidden" value="{{$bank->id}}" name="bpm_id">
                            <input type="hidden" name="total_amount" value="10000">
                            <input type="hidden" name="description" value="test">
                            <input type="hidden" name="url_success" value="{{route('test_success')}}">
                            <input type="hidden" name="url_detail" value="{{route('test_detail')}}">
                            <input type="hidden" name="merchant_id" value="34773">
                            <input type="hidden" name="accept_bank" value="1">
                            <input type="hidden" name="accept_cc" value="0">
                            <input type="hidden" name="accept_qrpay" value="0">
                            <input type="hidden" name="accept_e_wallet" value="0">
                            <input type="hidden" name="webhooks" value="">
                            <input type="hidden" name="customer_email" value="nguyenduc2512@gmail.com">
                            <input type="hidden" name="customer_phone" value="0111111111">
                            <input type="hidden" name="customer_name" value="nguyenduc">
                            <input type="hidden" name="customer_address" value="thai-thinh-dong-da">
                        </form>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <button type="submit" class="btn btn-success" style="margin-left: 45%">Thanh Toán</button>
</html>
<script>
    $('.form_data').click( function () {
        $(this).closest('.row').find('form').removeAttr('style').removeClass("selected")
        $(this).addClass("selected")
        $('.selected').css({"border": "solid"})
    })
</script>
<script>
    $('.btn').click(function () {
        $('.selected').submit()
    })
</script>
