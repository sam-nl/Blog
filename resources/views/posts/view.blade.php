@extends('main')

@section('title')
View post
@endsection

@section('links')
<li class ="links"><a href="/users/show/{{$user->id}}">Back to profile</a></li>
@endsection

@section('content')

        <div id="app">
            <div class = "row">
                <div class = "col-lg-6">
                    <div class = "col py-1">
                        <h1>{{$user->username}} posted:</h1>
                        
                        <b>{{$post->content}}</b>
                    </div>
                </div>
                @if(\App\Models\Image::where('imageable_id',$post->id)->
                            where('imageable_type', 'App\Models\Post')->first('filename')['filename'] !=null)
                            <div class = "col-lg-6">
                                <img class = "w-100 image-fluid py-2" src={{ url('images/'.\App\Models\Image::where('imageable_id',$post->id)->
                                where('imageable_type', 'App\Models\Post')->first('filename')['filename']) }}>
                            </div>
                        @endif
                
            </div>
            <div class="row">
                <div class = "col-lg-1">
                    <b>Tags: </b>
                </div>
                @foreach ($tags as $tag)
                    <div class = "col-lg-1">
                        <p>{{$tag->name}}</p>
                    </div>
                @endforeach
                <hr>
            </div>
            <div class ="row">
                <div class = "col-lg-4">
                    <p>Comment on {{$user->username}}'s post</p>
                </div>
                <div class = "col-lg-4">
                    <div class ="row">
                        <input type="text" v-model="newComment" required>
                        @error('comment')<div class = "err"><p>{{$message}}<p></div>@enderror
                    </div>
                </div>
                <div class = "col-lg-4">
                    <button class = "btn btn-lg btn-primary" @click="createComment">Add comment</button>
                </div>
            </div>
            <h3 class = "py-4">Comments</h3>
            <hr>
            <div v-for="comment in comments">
                <div v-if="comment.post_id==={{$post->id}}">
                    <div class="row">
                        <div class = "col-lg-6">
                            <p>@{{comment.content}}</p>
                        </div class>
                        <div class = "col-lg-3">
                            <p>Commented by: @{{comment.user.username}}</p>
                        </div class>
                        <div class = "col-lg-3">
                            <div v-if="comment.user_id==={{Auth::user()->id}}">
                                <button  class="btn btn-lg  btn-danger" @click="deleteComment(comment)">Delete comment</button>
                            </div>
                            <div v-else-if="1 === {{Auth::user()->permissions}}">
                                <button  class="btn btn-lg  btn-danger" @click="deleteComment(comment)">Delete comment</button>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        <div>
    </div>

@endsection

@section('script')
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                comments: [],
                newComment: '',
                post: {{ $post->id }},
                user: {{Auth::user()->id}},
                editComment: '',
            },
            methods: {
                createComment: function(){
                    axios.post("/api/posts/"+this.post+"/comments",
                    {
                        comment: this.newComment,
                        user: this.user,
                        post: this.post,
                    })
                    .then(response=>
                    {
                        if (response.data==0) {
                            alert('Comment is blank');
                        }else if(response.data==1){
                            alert('Comment is limited to 100 characters');
                        }else {
                            console.log(response);
                            this.comments.push(response.data);
                            this.newComment = "";
                            this.getComments();
                        }      
                    })
                    .catch(response=>
                    {
                        console.log(response);
                    })
                },
                getComments: function(){
                    axios.get("/api/posts/"+this.post+"/comments")
                .then(response=>{
                    this.comments = response.data;
                })
                .catch(response=>{
                    console.log(response);
                })
                },
                deleteComment: function(comment){
                    axios.delete("/api/comments/"+comment.id+"/delete")
                .then(response=>{
                    this.getComments();
                })
                .catch(response=>{
                    console.log(response);
                })
                },
            },
            mounted(){
                this.getComments();
                
            },
        })
    </script>
@endsection