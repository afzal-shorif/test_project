<!DOCTYPE html>
<html>
<head>
    <title>{{$title}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />

</head>
<body>
    <div class="container">

    <a href="{{url('/cart')}}" style="float: right;">cart {{count(Session::get('cart'))}}</a>
    <a href="{{url('/logout')}}" style="float: right; margin-left: 10px; margin-right: 10px;">Logout</a>
    <h3 style="width: 1007px; margin: 0 auto; margin-bottom: 10px;">Available Resources:</h3>
    <ul style="width: 1007px; margin: 0 auto; list-style: none;">
        <?php
            $page = 1;
            if(isset($_GET['page'])) $page = $_GET['page'];

            foreach ($files as $file){
               $type = 'Free';
               $button = 'Download';
               $link = '/download/'.$file->source;

               if((int)$file->price != 0){
                   $type = $file->price;

                   if(!in_array((int)$file->resource_id, $purchase)){
                       $button = 'Add to Cart';
                       $link = 'add_to_cart/'.$page.'/'.$file->resource_id;
                   }
               }

        ?>

        <li style="border: 1px solid #dddddd; border-radius: 3px; padding: 10px; margin-bottom: 5px;">

            @if($file->type == 3)
                <a href="{{$file->description}}">{{$file->title}}</a><span style="float: right;">{{'free'}}</span>
            @else
                <p style="margin: 0px;">{{$file->title}}<span style="float: right;">{{$type}}</span></p>
                <p style="margin: 0px;">{{$file->description}}...show</p>
                <a href="{{url($link)}}"><button>{{$button}}</button></a>
            @endif

        </li>
        <?php
            }
        ?>
    </ul>
    <div class="row">
        {{ $files->links()}}
    </div>

    </div>
</body>
</html>
