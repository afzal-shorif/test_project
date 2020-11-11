<!DOCTYPE html>
<html>
<head><title>{{$title}}</title></head>
<body style="width: 1007px; margin: 0 auto; margin-bottom: 10px;">

    <h3>Cart:</h3>
    <table style="margin-bottom: 30px; width: 100%;" border="1">
        <tr>
            <td style="width: 10%">#</td>
            <td style="width: 40%">Name</td>
            <td style="width: 20%">Price</td>
            <td style="width: 30%">Remove</td>
        </tr>
        <?php
            $num = 0;
            $total = 0;
            foreach($data as $row){
                $num++;
                $total += $row->price;
        ?>

        <tr>
            <td>{{$num}}</td>
            <td>{{$row->title}}</td>
            <td>{{$row->price}}</td>
            <td><a href="{{url('/remove_to_cart/'.$row->resource_id)}}">Remove</a></td>
        </tr>
        <?php
            }
        ?>
    </table>
    @if($total>0)
        <h4 style="text-align: right;">{{'Total: '.$total}}</h4>
    @endif
    <br>
    @if(count($data)>0)
        <a href="{{url('/cart_confirm')}}"><button style="float: right;">Confirm</button></a>
    @endif

</body>
</html>
