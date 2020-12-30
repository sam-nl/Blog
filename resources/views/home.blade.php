@extends('main')

@section('title')
Glob home
@endsection

@section('links')
<li class ="links"><a href="/users/login">Login</a></li>
<li class ="links"><a href="/users/create">Register</a></li>
@endsection

@section('content')
<article>
    <div class="article-centre">
        <p> 
            Glob is website for gamers.
            You can make posts about the games you play.
            You can also view other posts. Enjoy globbing!
        </p>
    </div>
    @if (session('user')==null)
    <div class="article-centre">
        <p>
            You are not currently logged in, register or login
            with the links at the top.
        </p>
    </div>
        
    @endif
    <div id="app" style= "grid-column: 2">
        <div v-for="comment in comments">
            <div class="article-comment">
                <p>
                @{{comment.content}}
                </p>
            </div>
        <div>
        
    </div>
</article>
@endsection
@section('script')
    <script>
        
        var app = new Vue({
            el: '#app',
            data: {
                comments: []
            },
            mounted(){
                axios.get("{{route('api.comments.list')}}")
                .then(response=>{
                    this.comments = response.data;
                })
                .catch(response=>{
                    console.log(response);
                })
            },
        })
    </script>
@endsection