<div style="background: #fbfbfb;  border-radius: 5px;">
    <div style="border: 1px solid #EFEFEF;padding: 1%;">
        <strong><?php echo $title; ?></strong>
    </div>
    <div style="text-align: left;  padding: 0.5% 2%;  width: 89%;  word-wrap: break-word">
        @if( is_array($content) )
            {!! "<div style='width: 500px;'>" !!}
            @foreach($content as $key => $row)
                {!!
                    "<div style='border-radius: 5px; box-shadow: 0 1px 1px 3px #000'>
                        <strong style='font-weight: bold; width: 180px; text-align: right'>{$key}</strong>: {$row}
                    </div>"
                !!}
            @endforeach
            {!! "</div>" !!}
        @else
            {{ $content }}
        @endif
        @if( isset($dump) && count($dump) > 0 )
            {!! "<div><pre>".print_r($dump)."</pre></div>" !!}
        @endif
        <p>
            <strong>
                IP: {{ request()->getClientIp() }}
            </strong>
        </p>
    </div>
    <div style="border: 1px solid #EFEFEF;padding: 1%;text-align: center">
        <small>
            &copy; MRC - system - {!! '@development' !!} with Laravel Framework on your version {{ $app->version() }}
        </small>
    </div>
</div>