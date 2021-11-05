@extends('layouts.main-layout')

@section('title')
    <title>MIREA VIỆT NAM | {{config('app.club_name')}}</title>
@endsection
@section('content')
    <style>
        .section-first {
            background:linear-gradient(45deg, rgba(2,0,36,0.8) 0%, rgba(1,55,70,0.8) 50%, rgba(0,6,54,0.8) 100%),url(https://images.unsplash.com/photo-1542831371-29b0f74f9713?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxjb2xsZWN0aW9uLXBhZ2V8MXwyNTc0MjA0MXx8ZW58MHx8fHw%3D&w=1000&q=80);
        }

        .section-second {
            background:linear-gradient(45deg, rgba(250, 250, 255, 0.8) 0%, rgba(250, 253, 255, 0.8) 50%, rgba(241, 244, 255, 0.8) 100%),url(https://static.vecteezy.com/system/resources/previews/002/840/509/original/abstract-lines-and-dots-connect-on-white-background-technology-connection-digital-data-and-big-data-concept-vector.jpg);
        }

        h1 {
            font-size: 5em;
            color: white;
            text-transform: uppercase;
        }

        .span-typing {
            border-right: .05em solid;
            animation: caret 1s steps(1) infinite;
        }

        @keyframes caret {
            50% {
                border-color: transparent;
            }
        }

    </style>
    <section class="bg-accent bg-position-center bg-size-cover py-3 py-sm-5 section-first" >
        <div class="container py-5">
            <div class="row pt-md-5 pb-lg-5 justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-10 text-center py-xl-3 d-flex align-items-center justify-content-center">
                    <h1></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-secondary bg-position-center bg-size-cover py-3 py-sm-5 section-second" >
        <div class="container py-5">
            <h2 class="text-center"><strong>THÀNH VIÊN</strong></h2>
            <p></p>
            <div class="row pt-md-5 pb-lg-5 justify-content-center">
                @foreach($dataIKBOs as $ikbo)
                <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <img src="{{$urlPhoto}}/{{$ikbo->image}}" class="d-inline-block rounded-circle mb-3" width="96" alt="">
                        <h5 class="pt-1 mb-1">{{$ikbo->name}}</h5>
                        <p class="small text-muted"><em>{{$ikbo->email}}</em></p>
                        <a class="btn btn-sm btn-success fs-sm text-muted mb-3">{{$ikbo->position}}</a><br>
                        <a href="https://facebook.com/{{$ikbo->facebook}}" target="_blank" class="btn-social bs-facebook bs-outline bs-sm">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="https://instagram.com/{{$ikbo->instagram}}" target="_blank" class="btn-social bs-instagram bs-outline bs-sm">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://github.com/{{$ikbo->github}}" target="_blank" class="btn-social bs-vk bs-outline bs-sm">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="https://vk.com/{{$ikbo->github}}" target="_blank" class="btn-social bs-vk bs-outline bs-sm">
                            <i class="fab fa-vk"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded',function(event){
            // array with texts to type in typewriter
            var dataText = [ "WE", "ARE", "{{config('app.club_name')}}"];

            // type one text in the typwriter
            // keeps calling itself until the text is finished
            function typeWriter(text, i, fnCallback) {
                // chekc if text isn't finished yet
                if (i < (text.length)) {
                    // add next character to h1
                    document.querySelector("h1").innerHTML = text.substring(0, i+1) +'<span class="span-typing" aria-hidden="true"></span>';

                    // wait for a while and call this function again for next character
                    setTimeout(function() {
                        typeWriter(text, i + 1, fnCallback)
                    }, 100);
                }
                // text finished, call callback if there is a callback function
                else if (typeof fnCallback == 'function') {
                    // call callback after timeout
                    setTimeout(fnCallback, 700);
                }
            }
            // start a typewriter animation for a text in the dataText array
            function StartTextAnimation(i) {
                if (typeof dataText[i] == 'undefined'){
                    setTimeout(function() {
                        StartTextAnimation(0);
                    }, 20000);
                }
                // check if dataText[i] exists
                if (i < dataText[i].length) {
                    // text exists! start typewriter animation
                    typeWriter(dataText[i], 0, function(){
                        // after callback (and whole text has been animated), start next text
                        StartTextAnimation(i + 1);
                    });
                }
            }
            // start the text animation
            StartTextAnimation(0);
        });
    </script>
@endsection
