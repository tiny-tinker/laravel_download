@extends('layouts.app')

@section('title', 'Download')

@section('content')
    <div class="row margin-0">
        <h1 class="text-center mb-5">Download Whitepapers</h1>
        <div class="links-container">
            @foreach($urls as $url)
                <a class="download-whitepaper" data-href="{{ route('whitepaperDownload.download', $url['path']) }}">{{$url['lng']}}</a>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.download-whitepaper').click(downloadWhitepaper);
    });

    const downloadWhitepaper = function (){
        window.location = $(this).data('href');
    }
</script>    
@endsection